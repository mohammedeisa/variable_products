import React from 'react';
import ReactDOM from 'react-dom';

function ProductGallery() {
    return (
            <div className="col-md-7 col-sm-7 ">
                <div className="product-image">
                    <img src="images/prod-1.jpg" alt="..." />
                </div>
                <div className="product_gallery">
                    <a>
                        <img src="images/prod-2.jpg" alt="..." />
                    </a>
                    <a>
                        <img src="images/prod-3.jpg" alt="..." />
                    </a>
                    <a>
                        <img src="images/prod-4.jpg" alt="..." />
                    </a>
                    <a>
                        <img src="images/prod-5.jpg" alt="..." />
                    </a>
                </div>
            </div>);
}
export default ProductGallery;
