import { useContext } from "react";
import { Button } from "@nextui-org/button";
import { Link } from "@nextui-org/link";

import { AuthContext } from "@/components/auth";
import { title } from "@/components/primitives";
import DefaultLayout from "@/layouts/default";

export default function HackerPage() {
  const authProvider = useContext(AuthContext);

  return (
    <DefaultLayout>
      <section className="flex flex-col items-center justify-center gap-4 py-8 md:py-10">
        <div className="w-full text-center">
          {authProvider.isLoggedIn && authProvider.role === "Hacker" && (
            <>
              <h1 className={title()}>Hacker</h1>
              <div className="flex flex-col items-center justify-center py-8 space-y-8">
                <Button
                  showAnchorIcon
                  as={Link}
                  href="/hacker/users"
                  variant="bordered"
                >
                  View Users
                </Button>
                <Button
                  showAnchorIcon
                  as={Link}
                  href="/hacker/hackers"
                  variant="bordered"
                >
                  View Hackers
                </Button>
                <Button
                  showAnchorIcon
                  as={Link}
                  href="/hacker/committee"
                  variant="bordered"
                >
                  View Committee
                </Button>
                <Button
                  showAnchorIcon
                  as={Link}
                  href="/hacker/trustees"
                  variant="bordered"
                >
                  View Trustees
                </Button>
                <Button
                  showAnchorIcon
                  as={Link}
                  href="/hacker/admins"
                  variant="bordered"
                >
                  View Admins
                </Button>
              </div>
            </>
          )}
          {(!authProvider.isLoggedIn || authProvider.role !== "Hacker") && (
            <>
              <h1 className={title()}>Hacker</h1>
              <div className="flex flex-col items-center justify-center py-8 space-y-8">
                <p className="text-lg">
                  You are not authorized to access this page.
                </p>
                <Button
                  showAnchorIcon
                  as={Link}
                  color="default"
                  href="/sign-in"
                  size="md"
                  variant="bordered"
                >
                  Sign In
                </Button>
              </div>
            </>
          )}
        </div>
      </section>
    </DefaultLayout>
  );
}