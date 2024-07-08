import React from 'react'

const Stats = () => {
    return (
        <div className="max-w-6xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
            <div>
                <div className="flex flex-col items-center justify-start">
                    <div className="relative w-64 h-64 rounded-full overflow-hidden">
                        <img
                            src="https://images8.alphacoders.com/413/413481.jpg"
                            alt="Player Image"
                            width={300}
                            height={300}
                            className="w-full h-full object-cover"
                        />
                        <div className="absolute inset-0 bg-black/50 flex items-center justify-center">
                        </div>
                    </div>
                    <h1 className="text-4xl font-bold">Virat Kohli</h1>
                    <p className="text-lg text-muted-foreground mt-4">Indian Cricket Player</p>
                </div>
                <div className="grid gap-8">
                    <div className="grid gap-4">
                        <h2 className="text-3xl font-bold">Batting Statistics</h2>
                        <div className="grid md:grid-cols-2 grid-cols-1 gap-6">
                            <div className="bg-card p-6 rounded-lg shadow-md">
                                <h3 className="text-xl font-semibold">ODI</h3>
                                <div className="grid gap-3 text-muted-foreground mt-4">
                                    <div className="flex justify-between">
                                        <span>Innings</span>
                                        <span>265</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Runs</span>
                                        <span>12,169</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Average</span>
                                        <span>59.12</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Strike Rate</span>
                                        <span>93.25</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Half Centuries</span>
                                        <span>58</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Centuries</span>
                                        <span>43</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Highest Score</span>
                                        <span>183</span>
                                    </div>
                                </div>
                            </div>
                            <div className="bg-card p-6 rounded-lg shadow-md">
                                <h3 className="text-xl font-semibold">T20</h3>
                                <div className="grid gap-3 text-muted-foreground mt-4">
                                    <div className="flex justify-between">
                                        <span>Innings</span>
                                        <span>90</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Runs</span>
                                        <span>3,296</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Average</span>
                                        <span>50.71</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Strike Rate</span>
                                        <span>137.67</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Half Centuries</span>
                                        <span>28</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Centuries</span>
                                        <span>1</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Highest Score</span>
                                        <span>122*</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="grid gap-4">
                        <h2 className="text-3xl font-bold">Bowling Statistics</h2>
                        <div className="grid md:grid-cols-2 grid-cols-1 gap-6">
                            <div className="bg-card p-6 rounded-lg shadow-md">
                                <h3 className="text-xl font-semibold">ODI</h3>
                                <div className="grid gap-3 text-muted-foreground mt-4">
                                    <div className="flex justify-between">
                                        <span>Matches</span>
                                        <span>0</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Innings</span>
                                        <span>0</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Wickets</span>
                                        <span>0</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Average</span>
                                        <span>-</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Economy</span>
                                        <span>-</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Best Bowling</span>
                                        <span>-</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>5-Wicket Hauls</span>
                                        <span>0</span>
                                    </div>
                                </div>
                            </div>
                            <div className="bg-card p-6 rounded-lg shadow-md">
                                <h3 className="text-xl font-semibold">T20</h3>
                                <div className="grid gap-3 text-muted-foreground mt-4">
                                    <div className="flex justify-between">
                                        <span>Matches</span>
                                        <span>0</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Innings</span>
                                        <span>0</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Wickets</span>
                                        <span>0</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Average</span>
                                        <span>-</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Economy</span>
                                        <span>-</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>Best Bowling</span>
                                        <span>-</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span>5-Wicket Hauls</span>
                                        <span>0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Stats;
