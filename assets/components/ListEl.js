import React, {Component} from 'react';

class ListEl extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div key={this.props.feature.id} className="list_el">
                <img className="list_el_icon"
                     src={this.props.feature.icon} />
                <div className="list_el_inner">
                    <div className="list_el_title">
                        {this.props.feature.title}
                    </div>
                    <div className="list_el_description">
                        {this.props.feature.description}
                    </div>
                </div>
            </div>
        )
    }
}

export default ListEl;