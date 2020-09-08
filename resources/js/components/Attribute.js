import React from 'react';
import ReactDOM from 'react-dom';

function Attribute(attribute) {
    return (
            <li key={attribute.id} className='list-group-item'>
                {attribute.attribute.name}
            </li>


            );
}
export default Attribute;
