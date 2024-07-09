import Navbar from "@/Components/Navbar";
import "./globals.css";
import Footer from "@/Components/Footer";

export const metadata = {
  title: "Admin - The Cricket Nerd",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <head>
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'/>
      <link rel="shortcut icon" href="/Images/Logo/The Cricket Nerd.png" type="image/x-icon" />
    </head>
      <body>
        <Navbar/>
        {children}
        <Footer/>
        </body>
    </html>
  );
}
