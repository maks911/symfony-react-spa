import React from "react";
import PropTypes from 'prop-types';

const Icon = ({ name, className, width, height}) => (
    <svg className={`${className}`} width={width} height={height}>
        <use xlinkHref={`/build/images/sprite.svg#${name}`} />
    </svg>
);

Icon.propTypes = {
    name: PropTypes.string.isRequired,
    color: PropTypes.string,
    size: PropTypes.string
};

export default Icon;