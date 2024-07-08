import React from 'react'

const page = () => {
    return (
        <div className="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform hover:scale-105">
            <form action="#" method="POST">
                <h1 className="mb-6 text-2xl text-center text-teal-800">Upload News</h1>
                <div className="mb-5">
                    <label className="block mb-2 font-bold text-teal-900" htmlFor="title">Title</label>
                    <input className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="title" name="title" />
                </div>
                <div className="mb-5">
                    <label className="block mb-2 font-bold text-teal-900" htmlFor="description">Description</label>
                    <textarea className="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" id="description" name="description" rows="5"></textarea>
                </div>
                <div className="mb-5">
                    <label className="block mb-2 font-bold text-teal-900" htmlFor="screenshots">Select Best Photo</label>
                    <input className="w-full p-1 border border-teal-200 rounded-lg" type="file" id="screenshots" name="screenshots" accept="image/*" />
                </div>
                <button className="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
            </form>
        </div>
    )
}

export default page
