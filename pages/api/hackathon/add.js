import getClient from "@/utils/mongodb";
import { validateToken } from "@/utils/login";

export default async function handler(req, res) {
  const client = await getClient();

  try {
    if (req.method === "POST") {
      const authHeader = req.headers.authorization;

      if (!authHeader) {
        return res.status(401).json({ error: "Authorization header missing" });
      }

      const Login = client.db("Login");
      const Committee = Login.collection("Committee");
      const Trustee = Login.collection("Trustee");
      const Admin = Login.collection("Admin");

      const token = authHeader.split(" ")[1];

      if (!token) {
        return res.status(403).json({ error: "Invalid or missing token" });
      }

      const isCommittee = await validateToken({ Role: Committee, token });
      const isTrustee = await validateToken({ Role: Trustee, token });
      const isAdmin = await validateToken({ Role: Admin, token });

      if (!isCommittee && !isTrustee && !isAdmin) {
        return res.status(403).json({ error: "Invalid or expired token" });
      }

      const General = client.db("General");
      const Hackathon = General.collection("Hackathon");

      const newHackathon = req.body;

      if (!newHackathon || Object.keys(newHackathon).length === 0) {
        return res.status(400).json({ error: "Hackathon data is missing" });
      }

      const result = await Hackathon.insertOne(newHackathon);

      if (result.acknowledged) {
        res.status(201).json({ message: "Hackathon added successfully", id: result.insertedId });
      } else {
        res.status(500).json({ error: "Failed to add hackathon" });
      }
    } else {
      res.setHeader("Allow", ["POST"]);
      res.status(405).end(`Method ${req.method} Not Allowed`);
    }
  } catch (error) {
    res
      .status(500)
      .json({ error: "Unable to retrieve data from the database" });
  }
}
