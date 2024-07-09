"use client"
import axios from 'axios';
import React, { useState } from 'react'
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';


const page = () => {
    const Url = "http://localhost/admin/app/API/POST/News.php";
    const [Title, setTitle] = useState();
    const [Description, setDescription] = useState();
    const [Author, setAuthor] = useState();
    const [Image, setImage] = useState(null);
    const HandleFileChange = (e) => {
        setImage(e.target.files[0]);
    };
    const HandelSubmit = (e) => {
        e.preventDefault();
        let Form = new FormData();
        Form.append("Title", Title);
        Form.append("Description", Description);
        Form.append("Author", Author);
        if (Image) {
            Form.append("Image", Image);
        }
        axios.post(Url, Form).then((response) => {
            response = response.data;
            if (response == "Success") {
                setTitle('');
                setAuthor('');
                setDescription('');
                setImage(null);
                toast.success('News successfully uploaded', {
                    autoClose: 2000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
            } else if (response == "Error moving uploaded file") {
                toast.error('Error moving uploaded file', {
                    autoClose: 2000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
            } else if (response == "Image not selected") {
                toast.error('Image not selected', {
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
    return (<>
        <ToastContainer />
        <div className="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
            <form action="#" method="POST" onSubmit={HandelSubmit}>
                <h1 className="mb-6 text-2xl text-center text-teal-800">Upload News</h1>
                <div className="mb-5">
                    <label className="block mb-2 font-bold text-teal-900" htmlFor="title">Title</label>
                    <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" onChange={(e) => {
                        setTitle(e.target.value);
                    }} value={Title} />
                </div>
                <div className="mb-5">
                    <label className="block mb-2 font-bold text-teal-900" htmlFor="title">Author</label>
                    <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" onChange={(e) => {
                        setAuthor(e.target.value);
                    }} value={Author} />
                </div>
                <div className="mb-5">
                    <label className="block mb-2 font-bold text-teal-900" htmlFor="description">Description</label>
                    <textarea className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" rows="5" onChange={(e) => {
                        setDescription(e.target.value);
                    }} value={Description}></textarea>
                </div>
                <div className="mb-5">
                    <label className="block mb-2 font-bold text-teal-900" htmlFor="screenshots">Select Best Photo</label>
                    <input className="w-full p-1 border border-teal-200 rounded-lg" type="file" id="screenshots" name="screenshots" accept="image/*" onChange={HandleFileChange} />
                </div>
                <button className="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800">Submit</button>
            </form>
        </div>
    </>
    )
}

export default page
