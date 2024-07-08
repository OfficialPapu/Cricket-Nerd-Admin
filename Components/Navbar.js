"use client";
import { useGSAP } from '@gsap/react';
import { HiOutlineMenuAlt3 } from "react-icons/hi";
import { AiOutlineClose } from "react-icons/ai";
import Link from "next/link"
import gsap from 'gsap';
import { useState, useEffect } from 'react';

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false);

  useEffect(() => {
    if (isOpen == true && screen.width <= 1024) {
      gsap.to(".Navbar", {
        x: 0,
        duration: 0.3,
        ease: "power3.out",
      });
    } else if (isOpen == false && screen.width <= 1024) {
      gsap.to(".Navbar", {
        x: "400px",
        duration: 0.3,
        ease: "power3.in"
      });
    }
  }, [isOpen]);

  const toggleMenu = () => {
    setIsOpen(!isOpen);
  };

  return (<>
    <header className="flex h-20 w-full items-center justify-between px-4 md:px-6">
      <a className="mr-6 flex items-center justify-between" href="/">
        <img src="Logo/The Cricket Nerd.png" alt="Logo" width={100} />
      </a>
      <button
        className="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-background hover:bg-accent hover:text-accent-foreground h-10 w-10 ml-auto lg:hidden"
        data-state={isOpen ? "open" : "closed"}
        onClick={toggleMenu}
      >
        {isOpen ?  <AiOutlineClose  className='text-3xl'/> :<HiOutlineMenuAlt3  className='text-3xl'/>}
      </button>
      <nav className={`Navbar ${isOpen ? 'Active' : ''}`}>
        <ul className="flex flex-col list-none justify-center lg:flex-row lg:gap-9">
          <li>
            <Link href="/">Home</Link>
          </li>
          <li>
            <Link href="./News">News</Link>
          </li>
          <li>
            <Link href="./Matches">Matches</Link>
          </li>
          <li>
            <Link href="./Videos">Videos</Link>
          </li>
          <li>
            <Link href="./Statistics">Statistics</Link>
          </li>
          <li>
            <Link href="./Logout">Logout</Link>
          </li>
        </ul>
      </nav>
    </header>
  </>
  );
}
