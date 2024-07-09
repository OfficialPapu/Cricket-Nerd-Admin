"use client"
import axios from 'axios';
import React, { useState } from 'react';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

const Page = () => {
    const [PlayerName, setPlayerName] = useState('');
    const [PlayerRole, setPlayerRole] = useState('');
    const [PlayerType, setPlayerType] = useState('');
    const [BattingStyle, setBattingStyle] = useState('');
    const [BowlingStyle, setBowlingStyle] = useState('');
    const [Image, setImage] = useState(null);

    const handleFileChange = (e) => {
        setImage(e.target.files[0]);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        let formData = new FormData();
        formData.append("PlayerName", PlayerName);
        formData.append("PlayerRole", PlayerRole);
        formData.append("PlayerType", PlayerType);
        formData.append("BattingStyle", BattingStyle);
        formData.append("BowlingStyle", BowlingStyle);
        if (Image) {
            formData.append("Image", Image);
        }

        const url = "http://localhost/The Cricket Nerd/API/POST/New Player.php";
        axios.post(url, formData).then((response) => {
            response = response.data;
            if (response === "Success") {
                setPlayerName('');
                setPlayerRole('');
                setPlayerType('');
                setBattingStyle('');
                setBowlingStyle('');
                setImage(null);
                toast.success('Player successfully uploaded', {
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
        }).catch((error) => {
            toast.error('Something went wrong!', {
                autoClose: 2000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
        });
    };

    return (
        <>
            <ToastContainer />
            <div className="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
                <form action="#" method="POST" onSubmit={handleSubmit}>
                    <h1 className="mb-6 text-2xl text-center text-teal-800">New Player</h1>
                    <div className="mb-5">
                        <label className="block text-[13px] mb-[1px] font-bold text-teal-900" htmlFor="name">Player Name</label>
                        <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="name" name="name" value={PlayerName} onChange={(e) => setPlayerName(e.target.value)} />
                    </div>

                    <div className="mb-4">
                        <label htmlFor="role" className="block text-[13px] mb-[1px] font-semibold text-green-900">Player Role</label>
                        <select id="role" name="role"
                            className="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none"
                            value={PlayerRole} onChange={(e) => setPlayerRole(e.target.value)}>
                            <option value="">Select Role</option>
                            <option value="Batsman">Batsman</option>
                            <option value="Bowler">Bowler</option>
                            <option value="All-Rounder">All-Rounder</option>
                            <option value="Wicket-Keeper Batsman">Wicket-Keeper Batsman</option>
                        </select>
                    </div>

                    <div className="mb-4">
                        <label htmlFor="type" className="block text-[13px] mb-[1px] font-semibold text-green-900">Player Type</label>
                        <select
                            id="type" name="type"
                            className="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none"
                            value={PlayerType} onChange={(e) => setPlayerType(e.target.value)}>
                            <option value="">Select Type</option>
                            <option value="Right-Hand Batsman">Right-Hand Batsman</option>
                            <option value="Left-Hand Batsman">Left-Hand Batsman</option>
                            <option value="Right-Hand Bowler">Right-Hand Bowler</option>
                            <option value="Left-Hand Bowler">Left-Hand Bowler</option>
                        </select>
                    </div>

                    <div className="mb-4">
                        <label htmlFor="battingStyle" className="block text-[13px] mb-[1px] font-semibold text-green-900">Batting Style</label>
                        <select
                            id="battingStyle" name="battingStyle"
                            className="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none"
                            value={BattingStyle} onChange={(e) => setBattingStyle(e.target.value)}>
                            <option value="">Select Style</option>
                            <option value="Left Handed">Left Handed</option>
                            <option value="Right Handed">Right Handed</option>
                        </select>
                    </div>

                    <div className="mb-4">
                        <label htmlFor="bowlingStyle" className="block text-[13px] mb-[1px] font-semibold text-green-900">Bowling Style</label>
                        <select
                            id="bowlingStyle" name="bowlingStyle"
                            className="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none"
                            value={BowlingStyle} onChange={(e) => setBowlingStyle(e.target.value)}>
                            <option value="">Select Style</option>
                            <option value="Left Handed - Fast Bowler">Left Handed - Fast Bowler</option>
                            <option value="Right Handed - Fast Bowler">Right Handed - Fast Bowler</option>
                            <option value="Left Handed - Leg Spinner">Left Handed - Leg Spinner</option>
                            <option value="Right Handed - Leg Spinner">Right Handed - Leg Spinner</option>
                            <option value="Left Handed - Off Spinner">Left Handed - Off Spinner</option>
                            <option value="Right Handed - Off Spinner">Right Handed - Off Spinner</option>
                        </select>
                    </div>

                    <div className="mb-5">
                        <label className="block text-[13px] mb-[1px] font-bold text-teal-900" htmlFor="photo">Player Photo</label>
                        <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type='file' accept="image/*" onChange={handleFileChange} />
                    </div>
                    <button className="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
                </form>
            </div>
        </>
    )
}

export default Page;
