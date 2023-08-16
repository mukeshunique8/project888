function increment1() {
    var countElement = document.getElementById("tutor-el");
    var count = parseInt(countElement.innerText);
    countElement.innerText = count + 1;
}

// Function to decrement the count
function decrement1() {
    var countElement = document.getElementById("tutor-el");
    var count = parseInt(countElement.innerText);
    
    // Ensure count doesn't go below 0
    if (count > 0) {
        countElement.innerText = count - 1;
    }
}
/*-------------------------------------------------------*/
function increment2() {
    var countElement = document.getElementById("independent-el");
    var count = parseInt(countElement.innerText);
    countElement.innerText = count + 1;
}

// Function to decrement the count
function decrement2() {
    var countElement = document.getElementById("independent-el");
    var count = parseInt(countElement.innerText);
    
    // Ensure count doesn't go below 0
    if (count > 0) {
        countElement.innerText = count - 1;
    }
}
/*-------------------------------------------------------*/


/*-------------------------------------------------------*/
function increment3() {
    var countElement = document.getElementById("exit-el");
    var count = parseInt(countElement.innerText);
    countElement.innerText = count + 1;
}

// Function to decrement the count
function decrement3() {
    var countElement = document.getElementById("exit-el");
    var count = parseInt(countElement.innerText);
    
    // Ensure count doesn't go below 0
    if (count > 0) {
        countElement.innerText = count - 1;
    }
}
/*-------------------------------------------------------*/
function increment4() {
    var countElement = document.getElementById("exitPoints-el");
    var count = parseInt(countElement.innerText);
    countElement.innerText = count + 1;
}

// Function to decrement the count
function decrement4() {
    var countElement = document.getElementById("exitPoints-el");
    var count = parseInt(countElement.innerText);
    
    // Ensure count doesn't go below 0
    if (count > 0) {
        countElement.innerText = count - 1;
    }
}

/*-------------------------------------------------------*/
function increment5() {
    var countElement = document.getElementById("bonus-el");
    var count = parseInt(countElement.innerText);
    countElement.innerText = count + 1;
}

// Function to decrement the count
function decrement5() {
    var countElement = document.getElementById("bonus-el");
    var count = parseInt(countElement.innerText);
    
    // Ensure count doesn't go below 0
    if (count > 0) {
        countElement.innerText = count - 1;
    }
}

/*-------------------------------------------------------*/

function copyText(){
    var copyReport = document.getElementById("pgReport");
    copyReport.select();
    document.execCommand("copy");
    alert("COPIED SUCCESSFULLY")
}
/*-------------------------------------------------------*/

function concatenatedValues(){
let space = " "
let quotes = '"'
let dot = "."
let input1 = document.getElementById("studentName").value
let input2 = 'worked on the topic'
let input3 = document.getElementById("topic").value
let tutorValue = parseInt(document.getElementById("tutor-el").textContent)
let independentValue = parseInt(document.getElementById("independent-el").textContent)
let exitValue = parseInt(document.getElementById("exit-el").textContent)
let exitPointsValue = parseInt(document.getElementById("exitPoints-el").textContent)
let bonusValue = parseInt(document.getElementById("bonus-el").value)
let ppValue = parseInt(document.getElementById("points-el").value)
let ablePart = document.getElementById("able-el").value
let difficultyPart = document.getElementById("difficulty-el").value

let input4 = " " /*Tutor & Independent*/
let input5 = " " /*ABle &Difficulty*/
let input6 = " " /*exit ticket*/
let input7 = " " /*Bonus ticket*/
let input8 = "" /*Participation Points*/




if(tutorValue > 1 ){
    input4 = "The Student worked on "+tutorValue+" practice questions with Tutor's assistance."
} else if(tutorValue === 1) {
    input4 = "The Student worked on "+tutorValue+" practice question with Tutor's assistance."
}else if((independentValue === 1)){
    input4 = "The Student solved on "+independentValue+" practice question independently."
}else if((independentValue > 1)){
    input4 = "The Student solved on "+independentValue+" practice questions independently."
}else {
    input4 =" "
}


if((tutorValue ===1 && independentValue === 1)){
    input4 = " The Student worked on "+tutorValue+" practice question with the Tutor's assistance and solved "+independentValue+" question independently."
} else if((tutorValue ===1 && independentValue > 1)){
    input4 = " The Student worked on "+tutorValue+" practice question with the Tutor's assistance and solved "+independentValue+" questions independently."
} else if((tutorValue > 1 && independentValue === 1)){
    input4 = " The Student worked on "+tutorValue+" practice questions with the Tutor's assistance and solved "+independentValue+" question independently."
}else if((tutorValue > 1 && independentValue > 1)){
    input4 = " The Student worked on "+tutorValue+" practice questions with the Tutor's assistance and solved "+independentValue+" questions independently."
}



if((ablePart.length > 0 && difficultyPart.length> 0)){
    input5 = " The Student was able "+ablePart+" but faced difficulty with "+difficultyPart+"."
}else if(ablePart.length > 0){
    input5 = " The Student was able "+ablePart+"."
} else if(difficultyPart.length> 0){
    input5 = " The Student faced difficulty "+difficultyPart+"."
}



if(exitValue === 0){
    input6 = " The Student did not attempt any Exit Ticket Questions."
}else if (exitValue === 1){
    input6 = " The Student attempted "+exitValue+" Exit Ticket Question and scored "+exitPointsValue+" out of "+(exitValue*3)+" for an overall score of "+Math.floor(((exitPointsValue)/(exitValue*3)*100))+"%."
}else if (exitValue > 1){
    input6 = " The Student attempted "+exitValue+" Exit Ticket Questions and scored "+exitPointsValue+" out of "+(exitValue*3)+" for an overall score of "+Math.floor(((exitPointsValue)/(exitValue*3)*100))+"%."
}

if(bonusValue === 0){
    input7 = ""
} else if (bonusValue === 0){
    input7 = " "+input1+ " showcased great progress in the session by answering "+bonusValue+" additional Bonus Question."
} else if (bonusValue > 1){
    input7 = " "+input1+ " showcased great progress in the session by answering "+bonusValue+" additional Bonus Questions."

}





if(ppValue === 0){
    input8 = ""
} else if (ppValue === 1 ){
    input8 = " "+"Participation Point: "+ppValue+"."
} else {
  input8 =   " "+"Participation Points: "+ppValue+"."
}


var concatenated = input1+space+input2+space+quotes+input3+dot+quotes+space+input4+input5+"\n"+input6+input7+input8;
document.getElementById("pgReport").value = concatenated;


}
