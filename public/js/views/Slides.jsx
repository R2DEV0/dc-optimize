import React, { useState, useEffect } from 'react';

const Slides = () => {
    const [selected, setSelected] = useState("");
    const [galleries, setGalleries] = useState([]);

    useEffect(() => {
        const dcEl = document.getElementById('dc-slides');
        if (dcEl) {
            const galleryIds = dcEl.dataset.ids
            if(galleryIds){
                const idsArray = JSON.parse(galleryIds);
                setGalleries(idsArray);
            };
        };
    }, []);

    const handleSubmit = (value) => {
        if (value) {
            setSelected(value);
            document.location.href = `/dc-slides?gallery_id=${value}`;
        }
    };

    return (
        <div className='slides-wrapper col-12 my-4'>
            <div onSubmit={handleSubmit} className='col-lg-8 offset-lg-2 col-md-12 offset-md-0'>
                <select className='slides-select' onChange={e => handleSubmit(e.target.value)} value={selected}>
                    <option value="">Select Slideshow</option>
                    { galleries && galleries.length > 0 &&
                        galleries.map((item, i) => {
                            return(
                                <option value={item.id}>{item.title}</option>
                            )
                        })
                    }
                </select>
            </div>
        </div>
    );
}

export default Slides;

