import Image from "next/image";

export default function Home() {
  return (
    <div>
      <h1 className="text-center mb-5 w-full text-3xl font-bold">Sports Dashboard</h1>
      <main className="container mx-auto px-5 grid gap-5 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-2 mb-2">
        <section className="control bg-white p-5 rounded-lg shadow-md">
          <h2 className="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
            <i className="fas fa-futbol mr-2"></i> Matches Control
          </h2>
          <div className="control-buttons mb-4 text-center">
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              View All Matches
            </button>
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              Add New Match
            </button>
          </div>
          {/* Replace with appropriate React component or code */}
          {/* <MatchesControl /> */}
        </section>

        <section className="control bg-white p-5 rounded-lg shadow-md">
          <h2 className="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
            <i className="fas fa-newspaper mr-2"></i> News Control
          </h2>
          <div className="control-buttons mb-4 text-center">
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              View All News
            </button>
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              Add News Article
            </button>
          </div>
          {/* Replace with appropriate React component or code */}
          {/* <NewsControl /> */}
        </section>

        <section className="control bg-white p-5 rounded-lg shadow-md">
          <h2 className="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
            <i className="fas fa-chart-bar mr-2"></i> Statistics
          </h2>
          <div className="control-buttons mb-4 text-center">
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              View Statistics
            </button>
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              Generate Report
            </button>
          </div>
          {/* Replace with appropriate React component or code */}
          {/* <StatisticsControl /> */}
        </section>

        <section className="control bg-white p-5 rounded-lg shadow-md">
          <h2 className="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
            <i className="fas fa-video mr-2"></i> Videos Control
          </h2>
          <div className="control-buttons mb-4 text-center">
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              Watch Videos
            </button>
            <button className="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
              Upload Video
            </button>
          </div>
          {/* Replace with appropriate React component or code */}
          {/* <VideosControl /> */}
        </section>
      </main>
    </div>
  );
}
