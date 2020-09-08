import ReactDOM from 'react-dom';
import React, { useState, useEffect } from 'react';

import axios from 'axios';
import ProductGallery from './ProductGallery';
import Attribute from './Attribute';
function VariableProduct() {
    const [product, setProduct] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchPosts = async () => {
            setLoading(true);
            const res = await axios.get('http://127.0.0.1:8000/get_product_JSON/33');
            setProduct(res.data.product);
            setLoading(false);
        };

        fetchPosts();
    }, []);
    if (loading) {
    return null;
    } else{
    return (
            <div className="">
    <div className="page-title">
        <div className="title_left">
            <h3>{product.name}</h3>
        </div>
        <div className="title_right">
            <div className="col-md-5 col-sm-5 form-group pull-right top_search"> 
                <div className="input-group">
                    <input type='text' className='form-control' placeholder='Search for...'/>
                    <span className="input-group-btn">
                        <button className="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div className="clearfix"></div>

    <div className="row">
        <div className="col-md-12 col-sm-12 ">
            <div className="x_panel">
                <div className="x_title">
                    <h2>Gallery</h2>
                    <ul className="nav navbar-right panel_toolbox">
                        <li><a className="collapse-link"><i className="fa fa-chevron-up"></i></a>
                        </li>
                        <li className="dropdown">
                            <a href="#" className="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i className="fa fa-wrench"></i></a>
                            <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a className="dropdown-item" href="#">Settings 1</a>
                                <a className="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a className="close-link"><i className="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div className="clearfix"></div>
                </div>
                <div className="x_content">

                    <ProductGallery></ProductGallery>


                    <div className="col-md-5 col-sm-5 " style={{
            border: '0px solid #e5e5e5'}
}>

                        <h3 className="prod_title">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>

                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        <br />

                        <div className="">
                            <h2>{
            product.attributes.map(attribute => (
                    <Attribute key={attribute.id} attribute={attribute}></Attribute>
                    )
                    )
                                }

                                < /h2>
                                <ul className="list-inline prod_color display-layout">
                                    <li>
                                        <p>Green</p>
                                        <div className="color bg-green"></div>
                                    </li>
                                    <li>
                                        <p>Blue</p>
                                        <div className="color bg-blue"></div>
                                    </li>
                                    <li>
                                        <p>Red</p>
                                        <div className="color bg-red"></div>
                                    </li>
                                    <li>
                                        <p>Orange</p>
                                        <div className="color bg-orange"></div>
                                    </li>

                                </ul>
                        </div>
                        <br />

                        <div className="">
                            <h2>Size <small>Please select one</small></h2>
                            <ul className="list-inline prod_size display-layout">
                                <li>
                                    <button type="button" className="btn btn-default btn-xs">Small</button>
                                </li>
                                <li>
                                    <button type="button" className="btn btn-default btn-xs">Medium</button>
                                </li>
                                <li>
                                    <button type="button" className="btn btn-default btn-xs">Large</button>
                                </li>
                                <li>
                                    <button type="button" className="btn btn-default btn-xs">Xtra-Large</button>
                                </li>
                            </ul>
                        </div>
                        <br />

                        <div className="">
                            <div className="product_price">
                                <h1 className="price">Ksh80.00</h1>
                                <span className="price-tax">Ex Tax: Ksh80.00</span>
                                <br />
                            </div>
                        </div>

                        <div className="">
                            <button type="button" className="btn btn-default btn-lg">Add to Cart</button>
                            <button type="button" className="btn btn-default btn-lg">Add to Wishlist</button>
                        </div>

                        <div className="product_social">
                            <ul className="list-inline display-layout">
                                <li><a href="#"><i className="fa fa-facebook-square"></i></a>
                                </li>
                                <li><a href="#"><i className="fa fa-twitter-square"></i></a>
                                </li>
                                <li><a href="#"><i className="fa fa-envelope-square"></i></a>
                                </li>
                                <li><a href="#"><i className="fa fa-rss-square"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>


                    <div className="col-md-12">

                        <ul className="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li className="nav-item">
                                <a className="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                            </li>
                            <li className="nav-item">
                                <a className="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li className="nav-item">
                                <a className="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                        <div className="tab-content" id="myTabContent">
                            <div className="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                                {product.description
                                }
    









                            </div>
                            <div className="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                booth letterpress, commodo enim craft beer mlkshk aliquip
                            </div>
                            <div className="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                booth letterpress, commodo enim craft beer mlkshk 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

);
}
}


export default VariableProduct;
if (document.getElementById('variable_product')) 










    {
    ReactDOM.render(<VariableProduct />, document.getElementById('variable_product'));
}
    










