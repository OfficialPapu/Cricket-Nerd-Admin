"use client"
import axios from 'axios';
import React, { useState } from 'react';

export default function App() {
    const [formData, setFormData] = useState({
        Statistics: true,
        format: '',
        name: '',
        role: '',
        type: '',
        matches: '',
        innings: '',
        runs: '',
        highestScore: '',
        halfCenturies: '',
        centuries: '',
        strikeRate: '',
        average: '',
        economy: '',
        wickets: '',
        photo: null
    });

    const handleChange = (e) => {
        const { name, value, files } = e.target;
        if (name === 'photo') {
            setFormData((prevFormData) => ({
                ...prevFormData,
                [name]: files[0]
            }));
        } else {
            setFormData((prevFormData) => ({
                ...prevFormData,
                [name]: value
            }));
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const formDataToSubmit = new FormData();
        for (const key in formData) {
            formDataToSubmit.append(key, formData[key]);
        }
        axios.post("http://localhost/The Cricket Nerd/API/POST/Statistics.php", formData);
    };

    return (
        <div className="max-w-screen-md mx-auto mt-24 bg-white p-6 md:p-8 lg:p-10 rounded-lg shadow-md transition-transform duration-300 hover:scale-101">
            <form onSubmit={handleSubmit}>
                <h1 className="mb-6 text-2xl text-center text-teal-700">Insert Player Profile</h1>
                <div className="mb-4">
                    <label htmlFor="photo" className="block mb-2 font-semibold text-green-900">Player Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="format" className="block mb-2 font-semibold text-green-900">Match Format</label>
                    <select id="format" name="format" value={formData.format} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none">
                        <option value="">Select Format</option>
                        <option value="t20i">T20I</option>
                        <option value="odi">ODI</option>
                        <option value="domestic">Domestic</option>
                    </select>
                </div>
                <div className="mb-4">
                    <label htmlFor="name" className="block mb-2 font-semibold text-green-900">Player Name</label>
                    <input type="text" id="name" name="name" value={formData.name} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="role" className="block mb-2 font-semibold text-green-900">Player Role</label>
                    <select id="role" name="role" value={formData.role} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none">
                        <option value="">Select Role</option>
                        <option value="batsman">Batsman</option>
                        <option value="bowler">Bowler</option>
                        <option value="allRounder">All-Rounder</option>
                        <option value="wicketKeeper">Wicket Keeper</option>
                    </select>
                </div>
                <div className="mb-4">
                    <label htmlFor="type" className="block mb-2 font-semibold text-green-900">Player Type</label>
                    <select id="type" name="type" value={formData.type} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none">
                        <option value="">Select Type</option>
                        <option value="rightHandBatsman">Right-Hand Batsman</option>
                        <option value="leftHandBatsman">Left-Hand Batsman</option>
                        <option value="rightHandBowler">Right-Hand Bowler</option>
                        <option value="leftHandBowler">Left-Hand Bowler</option>
                    </select>
                </div>
                <div className="mb-4">
                    <label htmlFor="matches" className="block mb-2 font-semibold text-green-900">Total Matches</label>
                    <input type="number" id="matches" name="matches" value={formData.matches} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="innings" className="block mb-2 font-semibold text-green-900">Total Innings</label>
                    <input type="number" id="innings" name="innings" value={formData.innings} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="runs" className="block mb-2 font-semibold text-green-900">Runs Scored</label>
                    <input type="number" id="runs" name="runs" value={formData.runs} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="highestScore" className="block mb-2 font-semibold text-green-900">Highest Score</label>
                    <input type="number" id="highestScore" name="highestScore" value={formData.highestScore} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="halfCenturies" className="block mb-2 font-semibold text-green-900">Half Centuries</label>
                    <input type="number" id="halfCenturies" name="halfCenturies" value={formData.halfCenturies} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="centuries" className="block mb-2 font-semibold text-green-900">Centuries</label>
                    <input type="number" id="centuries" name="centuries" value={formData.centuries} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="strikeRate" className="block mb-2 font-semibold text-green-900">Strike Rate</label>
                    <input type="number" id="strikeRate" name="strikeRate" value={formData.strikeRate} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="average" className="block mb-2 font-semibold text-green-900">Batting Average</label>
                    <input type="number" id="average" name="average" value={formData.average} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="economy" className="block mb-2 font-semibold text-green-900">Bowling Economy</label>
                    <input type="number" id="economy" name="economy" value={formData.economy} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>
                <div className="mb-4">
                    <label htmlFor="wickets" className="block mb-2 font-semibold text-green-900">Wickets Taken</label>
                    <input type="number" id="wickets" name="wickets" value={formData.wickets} onChange={handleChange}
                        className="w-full px-4 py-2 border-2 border-green-200 rounded-md bg-green-100 transition duration-300 focus:border-teal-700 outline-none" />
                </div>

                <button type="submit" className="w-full px-4 py-2 border-none rounded-md bg-gradient-to-r from-teal-700 to-teal-900 text-white text-lg cursor-pointer transition duration-300 hover:from-teal-900">
                    Submit
                </button>
            </form>
        </div>
    );
}
