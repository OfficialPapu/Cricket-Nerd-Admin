"use client";
import { HiOutlineMenuAlt3 } from "react-icons/hi";
import { AiOutlineClose } from "react-icons/ai";
import Link from "next/link"
import gsap from 'gsap';
import { useState, useEffect } from 'react';

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false);

  useEffect(() => {
    if (isOpen && screen.width <= 1024) {
      gsap.to(".Navbar", {
        x: 0,
        duration: 0.3,
        ease: "power3.out",
      });
    } else if (!isOpen && screen.width <= 1024) {
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

  return (
    <>
      <header className="flex h-20 w-full items-center justify-between px-4 md:px-6">
        <a className="mr-6 flex items-center justify-between" href="/">
          <img src="/Images/Logo/The Cricket Nerd.png" alt="Logo" width={100} />
        </a>
        <button
          className="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-background hover:bg-accent hover:text-accent-foreground h-10 w-10 ml-auto lg:hidden"
          data-state={isOpen ? "open" : "closed"}
          onClick={toggleMenu}
        >
          {isOpen ? <AiOutlineClose className='text-3xl' /> : <HiOutlineMenuAlt3 className='text-3xl' />}
        </button>
        <nav className={`Navbar ${isOpen ? 'active' : ''} absolute lg:relative top-20 right-2 lg:top-0 lg:right-0 lg:flex lg:items-center lg:gap-9 bg-white shadow-lg lg:shadow-none lg:transform-none transform translate-x-full lg:translate-x-0 rounded-lg lg:rounded-none w-72 lg:w-auto h-96 lg:h-auto px-10 lg:p-0`}>
          <ul className="flex flex-col list-none justify-center lg:flex-row lg:gap-9">
            <li className="py-4 lg:py-0 text-lg lg:text-base">
              <Link href="/">Home</Link>
            </li>
            <li className="py-4 lg:py-0 text-lg lg:text-base">
              <Link href="/News">News</Link>
            </li>
            <li className="py-4 lg:py-0 text-lg lg:text-base">
              <Link href="/Matches">Matches</Link>
            </li>
            <li className="py-4 lg:py-0 text-lg lg:text-base">
              <Link href="/Videos">Videos</Link>
            </li>
            <li className="py-4 lg:py-0 text-lg lg:text-base">
              <Link href="/Statistics">Statistics</Link>
            </li>
            <li className="py-4 lg:py-0 text-lg lg:text-base">
              <Link href="/Logout">Logout</Link>
            </li>
          </ul>
        </nav>
      </header>
    </>
  );
}
