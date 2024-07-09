"use client"
import axios from 'axios';
import React, { useState } from 'react'
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

const page = () => {
    const Url = "http://localhost/admin/app/API/POST/Videos.php";
    const [VideoTitle, setVideoTitle] = useState();
    const [Description, setDescription] = useState();
    const [Link, setLink] = useState();
    const [Image, setImage] = useState(null);
    const HandleFileChange = (e) => {
        setImage(e.target.files[0]);
    };
    const HandelSubmit = (e) => {
        e.preventDefault();
        let Form = new FormData();
        Form.append("VideoTitle", VideoTitle);
        Form.append("Description", Description);
        Form.append("Link", Link);
        if (Image) {
            Form.append("Image", Image);
        }

        axios.post(Url, Form).then((response) => {
            response = response.data;
            if (response == "Success") {
                setVideoTitle('');
                setDescription('');
                setLink('');
                toast.success('Video successfully uploaded', {
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
        })
    }
    return (
        <>
            <ToastContainer />
            <div className="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
                <form action="#" method="POST" onSubmit={HandelSubmit}>
                    <h1 className="mb-6 text-2xl text-center text-teal-800">Upload Matches</h1>
                    <div className="mb-5">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="name">Title</label>
                        <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="name" name="name" value={VideoTitle} onChange={(e) => {
                            setVideoTitle(e.target.value);
                        }} />
                    </div>
                    <div className="mb-5">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="name">Video Link</label>
                        <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="name" name="name" value={Link} onChange={(e) => {
                            setLink(e.target.value);
                        }} />
                    </div>
                    <div className="mb-5">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="name">Description</label>
                        <textarea className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" rows="5" value={Description} onChange={(e) => {
                            setDescription(e.target.value);
                        }} />
                    </div>
                    <div className="mb-5">
                        <label className="block mb-2 font-bold text-teal-900" htmlFor="name">Thumbnail</label>
                        <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type='file'  accept="image/*" onChange={HandleFileChange}  />
                    </div>
                    <button className="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
                </form>
            </div>
        </>
    )
}

export default page
