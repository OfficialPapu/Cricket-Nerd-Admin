"use client";
import { FaCheck } from "react-icons/fa";
import { FaPlus } from "react-icons/fa";
import { IoMdCheckmark } from "react-icons/io";
import axios from "axios";
import React, { useState, useEffect, useRef } from "react";
import { toast, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const Page = () => {
    const urlget = "http://localhost/admin/app/API/GET/Matches.php";
    const urlpost = "http://localhost/admin/app/API/POST/Matches.php";
    const [TournamentName, setTournamentName] = useState("");
    const [CountryA, setCountryA] = useState("");
    const [CountryB, setCountryB] = useState("");
    const [Schedule, setSchedule] = useState("");
    const [Time, setTime] = useState("");
    const [DropdownOpenA, setDropdownOpenA] = useState(false);
    const [DropdownOpenB, setDropdownOpenB] = useState(false);
    const [plusOpenA, setPlusOpenA] = useState(false);
    const [plusOpenB, setPlusOpenB] = useState(false);
    const [selectedIconA, setSelectedIconA] = useState("https://generated.vusercontent.net/placeholder.svg");
    const [selectedIconB, setSelectedIconB] = useState("https://generated.vusercontent.net/placeholder.svg");
    const [highlightedIndexA, setHighlightedIndexA] = useState(-1);
    const [highlightedIndexB, setHighlightedIndexB] = useState(-1);
    const dropdownRefA = useRef(null);
    const dropdownRefB = useRef(null);

    const [options, setOptions] = useState([]);

    const handleDropdownCountryA = () => {
        setDropdownOpenA(!DropdownOpenA);
        setHighlightedIndexA(-1);
    };

    const handleDropdownCountryB = () => {
        setDropdownOpenB(!DropdownOpenB);
        setHighlightedIndexB(-1);
    };

    const handleCountryA = (option, icon) => {
        setCountryA(option);
        setSelectedIconA(icon);
        setDropdownOpenA(false);
        setHighlightedIndexA(-1);
        setPlusOpenA(true);
    };

    const handleCountryB = (option, icon) => {
        setCountryB(option);
        setSelectedIconB(icon);
        setDropdownOpenB(false);
        setHighlightedIndexB(-1);
        setPlusOpenB(true);
    };

    const handleKeyDownA = (e) => {
        if (DropdownOpenA) {
            e.preventDefault();
            if (e.key === "ArrowDown") {
                setHighlightedIndexA((prevIndex) => (prevIndex + 1) % options.length);
            } else if (e.key === "ArrowUp") {
                setHighlightedIndexA((prevIndex) => (prevIndex - 1 + options.length) % options.length);
            } else if (e.key === "Enter") {
                const selectedOption = options[highlightedIndexA];
                handleCountryA(selectedOption['Country Name'], `/Flags/1x1/${selectedOption['Icon']}`);
                setHighlightedIndexA(-1);
            } else {
                const char = e.key.toLowerCase();
                let currentIndex = highlightedIndexA;
                let foundIndex = -1;
                for (let i = 1; i <= options.length; i++) {
                    const option = options[(currentIndex + i) % options.length];
                    if (option['Country Name'].toLowerCase().startsWith(char)) {
                        foundIndex = (currentIndex + i) % options.length;
                        break;
                    }
                }

                if (foundIndex !== -1) {
                    setHighlightedIndexA(foundIndex);
                    setTimeout(() => scrollOptionIntoViewA(foundIndex), 0);
                }
            }
        }
    };

    const handleKeyDownB = (e) => {
        if (DropdownOpenB) {
            e.preventDefault();
            if (e.key === "ArrowDown") {
                setHighlightedIndexB((prevIndex) => (prevIndex + 1) % options.length);
            } else if (e.key === "ArrowUp") {
                setHighlightedIndexB((prevIndex) => (prevIndex - 1 + options.length) % options.length);
            } else if (e.key === "Enter") {
                const selectedOption = options[highlightedIndexB];
                handleCountryB(selectedOption['Country Name'], `/Flags/1x1/${selectedOption['Icon']}`);
                setHighlightedIndexB(-1);
            } else {
                const char = e.key.toLowerCase();
                let currentIndex = highlightedIndexB;
                let foundIndex = -1;
                for (let i = 1; i <= options.length; i++) {
                    const option = options[(currentIndex + i) % options.length];
                    if (option['Country Name'].toLowerCase().startsWith(char)) {
                        foundIndex = (currentIndex + i) % options.length;
                        break;
                    }
                }

                if (foundIndex !== -1) {
                    setHighlightedIndexB(foundIndex);
                    setTimeout(() => scrollOptionIntoViewB(foundIndex), 0);
                }
            }
        }
    };

    const scrollOptionIntoViewA = () => {
        if (dropdownRefA.current && dropdownRefA.current.children[highlightedIndexA]) {
            const option = dropdownRefA.current.children[highlightedIndexA];
            const container = dropdownRefA.current;

            const optionRect = option.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();

            if (optionRect.bottom > containerRect.bottom) {
                container.scrollTop += optionRect.bottom - containerRect.bottom;
            } else if (optionRect.top < containerRect.top) {
                container.scrollTop -= containerRect.top - optionRect.top;
            }
        }
    };

    const scrollOptionIntoViewB = () => {
        if (dropdownRefB.current && dropdownRefB.current.children[highlightedIndexB]) {
            const option = dropdownRefB.current.children[highlightedIndexB];
            const container = dropdownRefB.current;

            const optionRect = option.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();

            if (optionRect.bottom > containerRect.bottom) {
                container.scrollTop += optionRect.bottom - containerRect.bottom;
            } else if (optionRect.top < containerRect.top) {
                container.scrollTop -= containerRect.top - optionRect.top;
            }
        }
    };

    useEffect(() => {
        ListAllCountry();
        dropdownRefA.current.focus();
        dropdownRefB.current.focus();
    }, []);

    const handleSubmit = (e) => {
        e.preventDefault();
        let form = new FormData();
        form.append("TournamentName", TournamentName);
        form.append("CountryA", CountryA);
        form.append("CountryB", CountryB);
        form.append("Schedule", Schedule);
        form.append("Time", Time);
        axios.post(urlpost, form)
            .then((response) => {
                response = response.data;
                if (response === "Success") {
                    setTournamentName("");
                    setCountryA("");
                    setCountryB("");
                    setSelectedIconA("https://generated.vusercontent.net/placeholder.svg");
                    setSelectedIconB("https://generated.vusercontent.net/placeholder.svg");
                    setSchedule("");
                    setTime("");
                    toast.success("Matches successfully uploaded", {
                        autoClose: 2000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                } else {
                    toast.error("Something went wrong!", {
                        autoClose: 2000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                }
            })
            .catch((error) => {
                toast.error("Something went wrong!", {
                    autoClose: 2000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
            });
    };

    const ListAllCountry = async () => {
        try {
            let response = await axios.get(urlget, { params: { ListAllCountry: true } });
            let data = response.data;
            if (data.length > 0) {
                setOptions(data);
            } else {
                console.log("No data received");
            }
        } catch (error) {
            console.error("Error fetching data: ", error);
        }
    };

    return (
        <>
            <ToastContainer />
            <div className="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
                <form onSubmit={handleSubmit}>
                    <h1 className="mb-6 text-2xl text-center text-teal-800">Upload Matches</h1>
                    <div className="mb-5">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="name">
                            Tournament Name
                        </label>
                        <input
                            className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none"
                            type="text"
                            id="name"
                            name="name"
                            value={TournamentName}
                            onChange={(e) => setTournamentName(e.target.value)}
                        />
                    </div>
                    <div className="mb-5 relative">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="countryA">
                            Country A
                        </label>
                        <div className="flex items-center justify-between w-full px-4 py-2 rounded-md hover:bg-muted border cursor-pointer"
                            onClick={handleDropdownCountryA}
                            ref={dropdownRefA}
                            tabIndex="0"
                            onKeyDown={handleKeyDownA}>
                            <div className="flex items-center gap-2">
                                <img
                                    src={selectedIconA}
                                    alt="Selected option"
                                    width={24}
                                    height={24}
                                    className="rounded-md"
                                />
                                <span>{CountryA || "Select a Flag"}</span>
                            </div>
                            {plusOpenA ? <FaCheck /> : <FaPlus />}
                        </div>
                        {DropdownOpenA && (
                            <div className="absolute w-full bg-background shadow-lg rounded-md border mt-2 z-10 bg-white h-[300px] overflow-auto">
                                <div className="px-4 py-3 font-medium border-b">Choose an option</div>
                                {options.map((option, index) => (
                                    <div
                                        key={option['Country Name']}
                                        onClick={() => handleCountryA(option['Country Name'], `Images/Flags/${option['Icon']}`)}
                                        className={`flex items-center gap-3 px-4 py-3 hover:bg-muted rounded-t-md cursor-pointer ${highlightedIndexA === index ? "bg-gray-200" : ""}`}
                                    >
                                        <img
                                            src={`Images/Flags/${option['Icon']}`}
                                            alt={option['Country Name']}
                                            width={32}
                                            height={32}
                                            className="rounded-md"
                                        />
                                        <div className="flex-1">
                                            <div className="font-medium">{option['Country Name']}</div>
                                            <p className="text-sm text-muted-foreground">This is {option['Country Name']}</p>
                                        </div>
                                        {CountryA === option['Country Name'] && <IoMdCheckmark />}
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>
                    <div className="mb-5 relative">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="countryB">
                            Country B
                        </label>
                        <div className="flex items-center justify-between w-full px-4 py-2 rounded-md hover:bg-muted border cursor-pointer"
                            onClick={handleDropdownCountryB}
                            ref={dropdownRefB}
                            tabIndex="0"
                            onKeyDown={handleKeyDownB}>
                            <div className="flex items-center gap-2">
                                <img
                                    src={selectedIconB}
                                    alt="Selected option"
                                    width={24}
                                    height={24}
                                    className="rounded-md"
                                />
                                <span>{CountryB || "Select a Flag"}</span>
                            </div>
                            {plusOpenB ? <FaCheck /> : <FaPlus />}
                        </div>
                        {DropdownOpenB && (
                            <div className="absolute w-full bg-background shadow-lg rounded-md border mt-2 z-10 bg-white h-[300px] overflow-auto">
                                <div className="px-4 py-3 font-medium border-b">Choose an option</div>
                                {options.map((option, index) => (
                                    <div
                                        key={option['Country Name']}
                                        onClick={() => handleCountryB(option['Country Name'], `Images/Flags/${option['Icon']}`)}
                                        className={`flex items-center gap-3 px-4 py-3 hover:bg-muted rounded-t-md cursor-pointer ${highlightedIndexB === index ? "bg-gray-200" : ""}`}
                                    >
                                        <img
                                            src={`Images/Flags/${option['Icon']}`}
                                            alt={option['Country Name']}
                                            width={32}
                                            height={32}
                                            className="rounded-md"
                                        />
                                        <div className="flex-1">
                                            <div className="font-medium">{option['Country Name']}</div>
                                            <p className="text-sm text-muted-foreground">This is {option['Country Name']}</p>
                                        </div>
                                        {CountryB === option['Country Name'] && <IoMdCheckmark />}
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>
                    <div className="mb-5">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="schedule">
                            Schedule
                        </label>
                        <input
                            className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none"
                            type="date"
                            id="schedule"
                            name="schedule"
                            value={Schedule}
                            onChange={(e) => setSchedule(e.target.value)}
                        />
                    </div>
                    <div className="mb-5">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="time">
                            Time
                        </label>
                        <input
                            className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none"
                            type="time"
                            id="time"
                            name="time"
                            value={Time}
                            onChange={(e) => setTime(e.target.value)}
                        />
                    </div>
                    <button
                        className="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800"
                        type="submit"
                    >
                        Submit
                    </button>
                </form>
            </div>
        </>
    );
};

export default Page;
