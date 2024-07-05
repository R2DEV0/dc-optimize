import React from 'react';

const Dashboard = () => {

    return(
        <div className='dc-wrapper'>
            <div className="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12 mt-5 text-center">
                <h1>
                    Welcome to the NEW Depth & Complexity Software Suite!
                </h1>
                <h4 className='pt-1'>
                    Select an option from the dropdown to begin. 
                </h4>
                <p>Need help? <a className='dc-contactus' href='https://depthcomplexity.com/connect/' target="_blank">Contact us</a></p>
            </div>
        </div>
    )
};

export default Dashboard;