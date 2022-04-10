
function abstractJS(){
    let choice = document.querySelector('input[name="abstractScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("abstractDesc").innerHTML = "No evidence of abstract"
            break;
        case '1':
            document.getElementById("abstractDesc").innerHTML = "The overview of the abstract is poorly explained and insufficient."
            break;
        case '2':
            document.getElementById("abstractDesc").innerHTML = "The overview, objectives, deliverables of the project are covered and summarized."
            break;
        case '3':
            document.getElementById("abstractDesc").innerHTML = "The overview, objectives, deliverables, implementation methods, and conclusions of the project are covered and summarized."
            break;
        case '4':
            document.getElementById("abstractDesc").innerHTML = "The overview, objectives, deliverables, implementation methods, findings, and conclusions are covered, valid and summarized clearly."
            break;
        case '5':
            document.getElementById("abstractDesc").innerHTML = "Overall, the language and contents of this section is beyond expectation."
            break;
    }
}

function problemJS(){
    let choice = document.querySelector('input[name="problemStatementScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("problemStatementDesc").innerHTML = "No evidence of problem statement and project objective."
            break;
        case '1':
            document.getElementById("problemStatementDesc").innerHTML = "Problem statements and project objectives are listed and described."
            break;
        case '2':
            document.getElementById("problemStatementDesc").innerHTML = "Problem statements, project objectives, expected findings (research-type) or deliverables (application-type) are listed and described."
            break;
        case '3':
            document.getElementById("problemStatementDesc").innerHTML = "Problems statements, project objectives, expected findings (research-type) or deliverables (application-type) are listed and described clearly."
            break;
        case '4':
            document.getElementById("problemStatementDesc").innerHTML = "Problem statements, project objectives expected findings (research-type) are sound, revealing, reasonable and achievable.\n" +
                "The deliverables (application-type) are interesting, challenging, novel, reasonable and achievable."
            break;
        case '5':
            document.getElementById("problemStatementDesc").innerHTML = "Overall, the language and contents of this section is beyond expectation."
            break;
    }
}

function literatureJS(){
    let choice = document.querySelector('input[name="literatureScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("literatureReviewDesc").innerHTML = "No evidence of literature review / background study."
            break;
        case '1':
            document.getElementById("literatureReviewDesc").innerHTML = "The literature review / background study is poorly written, disorganized and fails to show the relatedness to the project."
            break;
        case '2':
            document.getElementById("literatureReviewDesc").innerHTML = "The literature review / background study is understandable but insufficient in explaining the state of art related to the project undertaken."
            break;
        case '3':
            document.getElementById("literatureReviewDesc").innerHTML = "Same as previous scale with these additions:\n" +
                "The literature review is relevant and covers current major topics of the research project (research-type).\n" +
                "The background study covers at least 3 related applications (application-type)."
            break;
        case '4':
            document.getElementById("literatureReviewDesc").innerHTML = "Same as previous scale with these additions:\n" +
                "The literature review or background study is written in a clear and easy to understand manner.\n" +
                "The flow of thought and ideas are continuous and smooth."
            break;
        case '5':
            document.getElementById("literatureReviewDesc").innerHTML = "Same as previous scale with these additions:\n" +
                "Overall, the analyses and discussions of the key issues are beyond expectation."
            break;
    }
}

function proposeSolutionJS(){
    let choice = document.querySelector('input[name="proposeSolutionScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("proposedSolutionDesc").innerHTML = "No evidence of proposal."
            break;
        case '1':
            document.getElementById("proposedSolutionDesc").innerHTML = "Proposal to be used is\n" +
                "poorly explained and insufficient to solve the problem identified."
            break;
        case '2':
            document.getElementById("proposedSolutionDesc").innerHTML = "Proposal to be used is adequately explained and suitable to solve the problem."
            break;
        case '3':
            document.getElementById("proposedSolutionDesc").innerHTML = "Proposal is suitable and technically sound;\n" +
                "Prototype/Proof-of- concept/Simulation clearly implement the proposal"
            break;
        case '4':
            document.getElementById("proposedSolutionDesc").innerHTML = "Proposal is\n" +
                "suitable, technically sound and well described;\n" +
                "Prototype/Proof-of- concept/Simulation clearly implement the proposal;\n" +
                "Suitable evaluation methods to be used are clearly justified."
            break;
        case '5':
            document.getElementById("proposedSolutionDesc").innerHTML = "Same as previous scale with these additions:\n" +
                "Overall, the project generates high value in exploration, creativity, novelty or innovation through the proposed methods and techniques."
            break;
    }
}

function spellingJS(){
    let choice = document.querySelector('input[name="spellingScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("spellingDesc").innerHTML = "Incomprehensible e writing."
            break;
        case '1':
            document.getElementById("spellingDesc").innerHTML = "Makes repeated grammatical and syntactical errors; frequently misspells; distract from understanding."
            break;
        case '2':
            document.getElementById("spellingDesc").innerHTML = "Errors are less than 50% and do not interfere with reading and understanding."
            break;
        case '3':
            document.getElementById("spellingDesc").innerHTML = "Errors are less than 20% and do not interfere with reading and understanding."
            break;
        case '4':
            document.getElementById("spellingDesc").innerHTML = "Writes generally correct prose; occasionally fails to catch minor grammatical errors."
            break;
        case '5':
            document.getElementById("spellingDesc").innerHTML = "Proofreads well enough to eliminate most grammatical errors"
            break;
    }
}

function writeStyleJS(){
    let choice = document.querySelector('input[name="writeStyleScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("writeStyleDesc").innerHTML = "Incomprehensible e writing."
            break;
        case '1':
            document.getElementById("writeStyleDesc").innerHTML = "Sentence structure, word choice, and lack of sequencing of ideas make reading difficult to follow; lack of appropriate sections or many items are in the wrong section."
            break;
        case '2':
            document.getElementById("writeStyleDesc").innerHTML = "Sentence structure and/or word choice sometimes interfere with clarity; sequencing of ideas within paragraphs and transitions between paragraphs need to be improve to make reading easy to follow; Some of the information is in the wrong section."
            break;
        case '3':
            document.getElementById("writeStyleDesc").innerHTML = "Sentence structure and/or word choice somewhat interfere with clarity but sequencing of ideas within paragraphs and transitions between paragraphs make reading easy to follow; Organization of information is generally correct but still has room for improvement."
            break;
        case '4':
            document.getElementById("writeStyleDesc").innerHTML = "Sentences are structured and words are chosen to communicate ideas clearly; sequencing of ideas within paragraphs and transitions between paragraphs make reading easy to follow."
            break;
        case '5':
            document.getElementById("writeStyleDesc").innerHTML = "Overall, the language and contents of this section is beyond expectation."
            break;
    }
}

function figureJS(){
    let choice = document.querySelector('input[name="figureScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("figureDesc").innerHTML = "No relevant figure, table and graph."
            break;
        case '1':
            document.getElementById("figureDesc").innerHTML = "Less than 30%\n" +
                "compliance to required format; captions are ineffective in communicating content;\n" +
                "ineffective visual representation; exhibit little understanding of important features or issues in the explanation."
            break;
        case '2':
            document.getElementById("figureDesc").innerHTML = "At least 50%\n" +
                "compliance to the required format; captions are ineffective in communicating content;\n" +
                "some of the data being visualized ineffectively; important features or issues are not communicated well in the explanation."
            break;
        case '3':
            document.getElementById("figureDesc").innerHTML = "At least 80%\n" +
                "compliance to the required format; captions are effective in communicating content;\n" +
                "data is being visualized and interpreted effectively but important features are not communicated well in the explanation."
            break;
        case '4':
            document.getElementById("figureDesc").innerHTML = "Correct format of figures, tables, and graphs;\n" +
                "captions effectively communicate content;\n" +
                "data is being visualized and interpreted effectively; important features are noted in the explanation."
            break;
        case '5':
            document.getElementById("figureDesc").innerHTML = "Correct format of figures, tables, and graphs;\n" +
                "captions effectively communicate content;\n" +
                "data is being visualized effectively;\n" +
                "all visualizations are effectively interpreted and discussed in the report."
            break;
    }
}

function abbreviationJS(){
    let choice = document.querySelector('input[name="abbreviationScore"]:checked').value;

    switch (choice){
        case '0':
            document.getElementById("abbreviationsDesc").innerHTML = "No evidence of reference"
            break;
        case '1':
            document.getElementById("abbreviationsDesc").innerHTML = "Less than 30% compliance to required format; More than 80% of the references are incomplete, insufficient, out dated or not relevant."
            break;
        case '2':
            document.getElementById("abbreviationsDesc").innerHTML = "Less than 50% compliance to required format; More than 50% of the references are incomplete, insufficient, out dated or not relevant."
            break;
        case '3':
            document.getElementById("abbreviationsDesc").innerHTML = "Less than 80% compliance to required format; More than 30% of the references are incomplete, insufficient, out dated or not relevant."
            break;
        case '4':
            document.getElementById("abbreviationsDesc").innerHTML = "Minimum\n" +
                "formatting error. Almost all the references are complete, sufficient, updated and relevant."
            break;
        case '5':
            document.getElementById("abbreviationsDesc").innerHTML = "Correct format. All references are complete, sufficient, updated and relevant."
            break;
    }
}