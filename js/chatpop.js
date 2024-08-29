document.getElementById("open-chat").addEventListener("click", function() {
  document.getElementById("chat-popup").style.display = "block";
});

document.getElementById("close-chat").addEventListener("click", function() {
  document.getElementById("chat-popup").style.display = "none";
});

document.getElementById("send-message").addEventListener("click", function() {
  var messageInput = document.getElementById("message-input").value;
  if (messageInput.trim() !== "") {
    var messageElement = document.createElement("div");
    messageElement.classList.add("sender");
    messageElement.textContent = messageInput;
    document.querySelector(".messages").appendChild(messageElement);
    document.getElementById("message-input").value = "";
  }
});
