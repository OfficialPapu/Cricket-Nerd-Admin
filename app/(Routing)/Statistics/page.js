"use client";
import { IoMdCheckmark } from "react-icons/io";
import { FaCheck } from "react-icons/fa";
import { FaPlus } from "react-icons/fa";
import axios from 'axios';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import React, { useEffect, useRef, useState } from 'react';
import Link from 'next/link';
export default function App() {
    const [options, setOptions] = useState([]);
    const [Player, setPlayer] = useState("");
    const [PlayerID, setPlayerID] = useState("");
    const [DropdownOpen, setDropdownOpen] = useState(false);
    const [plusOpen, setPlusOpen] = useState(false);
    const [selectedIcon, setSelectedIcon] = useState("https://generated.vusercontent.net/placeholder.svg");
    const dropdownRef = useRef(null);
    const [highlightedIndex, setHighlightedIndex] = useState(-1);

    const handleDropdownPlayer = () => {
        setDropdownOpen(!DropdownOpen);
        setHighlightedIndex(-1);
    };

    const handlePlayer = (option, ID, icon) => {
        setPlayer(option);
        setPlayerID(ID);
        setSelectedIcon(icon);
        setDropdownOpen(false);
        setHighlightedIndex(-1);
        setPlusOpen(true);
    };

    const handleKeyDownA = (e) => {
        if (DropdownOpen) {
            e.preventDefault();
            if (e.key === "ArrowDown") {
                setHighlightedIndex((prevIndex) => (prevIndex + 1) % options.length);
            } else if (e.key === "ArrowUp") {
                setHighlightedIndex((prevIndex) => (prevIndex - 1 + options.length) % options.length);
            } else if (e.key === "Enter") {
                const selectedOption = options[highlightedIndex];
                handlePlayer(selectedOption['Player Name'], selectedOption['ID'], `http://localhost/The Cricket Nerd/API/POST/${selectedOption['Player Photo']}`);
                setHighlightedIndex(-1);
            } else {
                const char = e.key.toLowerCase();
                let currentIndex = highlightedIndex;
                let foundIndex = -1;
                for (let i = 1; i <= options.length; i++) {
                    const option = options[(currentIndex + i) % options.length];
                    if (option['Player Name'].toLowerCase().startsWith(char)) {
                        foundIndex = (currentIndex + i) % options.length;
                        break;
                    }
                }

                if (foundIndex !== -1) {
                    setHighlightedIndex(foundIndex);
                    setTimeout(() => scrollOptionIntoViewA(foundIndex), 0);
                }
            }
        }
    };

    useEffect(() => {
        ListPlayers();
        dropdownRef.current.focus();
    }, []);

    const ListPlayers = async () => {
        try {
            let response = await axios.get("http://localhost/The Cricket Nerd/API/GET/Statistics.php", { params: { ListAllPlayers: true } });
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

    const [formData, setFormData] = useState({
        Statistics: true,
        format: '',
        matches: '',
        innings: '',
        runs: '',
        strikeRate: '',
        highestScore: '',
        halfCenturies: '',
        centuries: '',
        average: '',
        economy: '',
        wickets: '',
    });

    const handleChange = (e) => {
        const { name, value, files } = e.target;
        setFormData((prevFormData) => ({
            ...prevFormData,
            [name]: value
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const formDataToSubmit = new FormData();
        for (const key in formData) {
            formDataToSubmit.append(key, formData[key]);
        }
        formDataToSubmit.append("PlayerID", PlayerID);
        let response = await axios.post("http://localhost/The Cricket Nerd/API/POST/Statistics.php", formDataToSubmit, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        console.log(formDataToSubmit);
        response = response.data;
        if (response == "Success") {
            setFormData({
                Statistics: true,
                format: '',
                matches: '',
                innings: '',
                runs: '',
                strikeRate: '',
                highestScore: '',
                halfCenturies: '',
                centuries: '',
                average: '',
                economy: '',
                wickets: '',
            });
            toast.success('Statistics successfully uploaded', {
                autoClose: 2000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
        } else if (response == "DataMissing") {
            toast.error('All Field is Required!', {
                autoClose: 2000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
        } else {
            toast.error('Something went wrong!', {
                autoClose: 2000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
        }
    };

    return (
        <>
            <ToastContainer />
            <div className="max-w-[600px] mx-auto my-10 bg-white p-5 rounded-lg shadow-lg -transform transform">
                <form onSubmit={handleSubmit}>
                    <div className='flex justify-between items-center mb-6'>
                        <h1 className="text-2xl text-center text-teal-700">Insert Player Profile</h1>
                        <Link href={"./Statistics/NewPlayer"} className='bg-[#d4edda] p-[10px] rounded-lg text-[#155724] font-bold text-[13px]'>New Player</Link>
                    </div>


                    <div className="mb-5 relative">
                        <div className="flex items-center justify-between w-full px-4 py-2 rounded-md hover:bg-muted border cursor-pointer"
                            onClick={handleDropdownPlayer}
                            ref={dropdownRef}
                            tabIndex="0"
                            onKeyDown={handleKeyDownA}>
                            <div className="flex items-center gap-2">
                                <img
                                    src={selectedIcon}
                                    alt="Selected option"
                                    width={24}
                                    height={24}
                                    className="rounded-md"
                                />
                                <span>{Player || "Select a Player"}</span>
                            </div>
                            {plusOpen ? <FaCheck /> : <FaPlus />}
                        </div>
                        {DropdownOpen && (
                            <div className="absolute w-full bg-background shadow-lg rounded-md border mt-2 z-10 bg-white h-[300px] overflow-auto">
                                <div className="px-4 py-3 font-medium border-b">Choose an option</div>
                                {options.map((Item, index) => (
                                    <div
                                        key={Item['Player Name']}
                                        onClick={() => handlePlayer(Item['Player Name'], Item['ID'], `http://localhost/The Cricket Nerd/API/POST/${Item['Player Photo']}`)}
                                        className={`flex items-center gap-3 px-4 py-3 hover:bg-muted rounded-t-md cursor-pointer ${highlightedIndex === index ? "bg-gray-200" : ""}`}
                                    >
                                        <img
                                            src={`http://localhost/The Cricket Nerd/API/POST/${Item['Player Photo']}`}
                                            alt={Item['Player Name']}
                                            width={32}
                                            height={32}
                                            className="rounded-md"
                                        />
                                        <div className="flex-1">
                                            <div className="font-medium">{Item['Player Name']}</div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>


                    <div className="mb-4">
                        <label htmlFor="format" className="block mb-[1px] text-[12px]">Match Format</label>
                        <select id="format" name="format" value={formData.format} onChange={handleChange}
                            className="w-full px-3 py-[0.7rem] border rounded-md outline-none bg-green-50 border-teal-200">
                            <option value="">Select Format</option>
                            <option value="t20i">T20I</option>
                            <option value="odi">ODI</option>
                            <option value="domestic">Domestic</option>
                        </select>
                    </div>
                    <div className='flex justify-between gap-2'>
                        <div className="mb-4">
                            <label htmlFor="matches" className="block mb-[1px] text-[12px]">Total Matches</label>
                            <input type="number" id="matches" name="matches" value={formData.matches} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="innings" className="block mb-[1px] text-[12px]">Total Innings</label>
                            <input type="number" id="innings" name="innings" value={formData.innings} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="runs" className="block mb-[1px] text-[12px]">Runs Scored</label>
                            <input type="number" id="runs" name="runs" value={formData.runs} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                    </div>
                    <div className="mb-4">
                        <label htmlFor="strikeRate" className="block mb-[1px] text-[12px]">Strike Rate</label>
                        <input type="number" id="strikeRate" name="strikeRate" value={formData.strikeRate} onChange={handleChange}
                            className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                    </div>
                    <div className='flex justify-between gap-2'>
                        <div className="mb-4">
                            <label htmlFor="highestScore" className="block mb-[1px] text-[12px]">Highest Score</label>
                            <input type="number" id="highestScore" name="highestScore" value={formData.highestScore} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="halfCenturies" className="block mb-[1px] text-[12px]">Half Centuries</label>
                            <input type="number" id="halfCenturies" name="halfCenturies" value={formData.halfCenturies} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="centuries" className="block mb-[1px] text-[12px]">Centuries</label>
                            <input type="number" id="centuries" name="centuries" value={formData.centuries} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                    </div>


                    <div className='flex justify-between gap-2 mb-6'>
                        <div className="mb-4">
                            <label htmlFor="average" className="block mb-[1px] text-[12px]">Batting Average</label>
                            <input type="number" id="average" name="average" value={formData.average} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="economy" className="block mb-[1px] text-[12px]">Bowling Economy</label>
                            <input type="number" id="economy" name="economy" value={formData.economy} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="wickets" className="block mb-[1px] text-[12px]">Wickets Taken</label>
                            <input type="number" id="wickets" name="wickets" value={formData.wickets} onChange={handleChange}
                                className="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                        </div>
                    </div>

                    <button type="submit" className="w-full px-3 py-[.50rem] borderone rounded-md bg-gradient-to-r from-teal-700 to-teal-900 text-white text-lg cursor-pointer hover:from-teal-900">
                        Submit
                    </button>
                </form>
            </div>
        </>

    );
}
