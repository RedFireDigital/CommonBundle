var PartFireApi = React.createClass({

    getInitialState: function() {
        return {
            skeletonIntervalId : null,
        };
    },

    componentDidMount: function() {

    },

    handleStandardPost : function(url, data) {
        console.log("Sending data off now");
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            headers: {
                'Dwelltime-App': 'partfire/dwelltime/api',
                'Content-Type': 'application/json; charset=UTF-8'
            },
            success: function(data) {
                this.setState({loading : false});
                if (data.status == true) {
                    this.setState({ loading : false });
                } else {
                    console.log("Some error lad");
                }
            }.bind(this),
            error: function(xhr, status, err) {
                this.setState({loading : false});
                console.log("Some error lad");
            }.bind(this)
        });

    },

    handleStandardGet: function(url, showDone) {

        if (url != null) {

            this.setState({loading: true});

            $.ajax({
                url: url,
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    this.setState({loading: false});
                }.bind(this),
                error: function (xhr, status, err) {
                    this.setState({loading: false});
                    console.log("Some error lad");
                }.bind(this)
            });

            if (showDone) {
                $('#donemodal').modal({show: true});
            }
        } else {
            console.log("Bad URL - " + url);
        }

    },

    render : function () {
        return (
            <div>
                { this.showHeader() }
                { this.showFeedBack() }
                { this.showSections() }
                <Referencing
                    postUrl={ this.state.assignmentData.urls.newReference }
                    references={ this.getReferences() }
                    handleStandardGet={ this.handleStandardGet }
                    handleStandardPost={ this.handleStandardPost }
                />
                <Appendices
                    appendices={ this.getAppendices() }
                    handleStandardGet={ this.handleStandardGet }
                    postUrl={ this.state.appendixPostUrl }
                    handleStandardPost={ this.handleStandardPost }
                />
                <Feedback
                    academics={ this.state.academicsData }
                    handleStandardGet={ this.handleStandardGet }
                    academicFeedbackClicked={ this.academicFeedbackClicked }
                    setAcademicFeedbackAssignment={ this.setAcademicFeedbackAssignment }
                    isAcademic={this.state.isAcademic}
                />
                <AddNewSectionModal
                    members={ this.state.studentsData.members }
                    handleStandardPost={ this.handleStandardPost }
                    postUrl={ this.state.postNewSectionUrl }
                />
                <Comments
                    postUrl={ this.state.commentsPostUrl }
                    handleStandardPost={ this.handleStandardPost }
                    comments={ this.getSectionComments() }
                    closeCommentsClicked={ this.closeCommentsClicked }
                />
                <DeleteSectionModal getUrl={ this.state.deleteSectionUrl } handleStandardGet={ this.handleStandardGet }/>
                <AssignSectionToEditModal handleStandardGet={ this.handleStandardGet } allowLeaderToEditUrl={ this.state.allowLeaderToEditUrl } anyoneToEditUrl={ this.state.anyoneToEditUrl } />

            </div>
        )
    }
});