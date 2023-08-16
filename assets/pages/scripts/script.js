function copyToClipboard(text, button) {
    const tempInput = document.createElement('input');
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
  
    button.classList.add('copied-button');
  
    setTimeout(() => {
      button.classList.remove('copied-button');
    }, 1000);
  }
  