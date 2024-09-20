let textArea = document.getElementById("internship-description");
let characterCounter = document.getElementById("charCount");
const maxNumOfChars = textArea.maxLength;

const countCharacters = () => {
    let numOfEnteredChars = textArea.value.length;
    characterCounter.textContent = numOfEnteredChars + "/" + `${maxNumOfChars}`;
};

textArea.addEventListener("input", countCharacters);