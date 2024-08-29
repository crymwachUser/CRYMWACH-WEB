 const db = firebase.firestore();
    const messagesRef = db.collection("messages");

    // Listen for new messages ordered by time
    messagesRef.orderBy("time", "asc").onSnapshot(snapshot => {
      snapshot.docChanges().forEach(change => {
        if (change.type === "added") {
          const message = change.doc.data();
          displayMessage(message.id, message.fullname, message.time, message.message);
        }
      });
    });

    // Send a new message
    function sendMessage() {
      const senderid = document.getElementById("id").innerText;
      const messageInput = document.getElementById("message");
      const text = messageInput.value;
      let currentDate = new Date();
      // Get the local date and time components
      let localDate = currentDate.toLocaleDateString(); // Local date (MM/DD/YYYY or based on browser's locale)
      let localTime = currentDate.toLocaleTimeString();
      let randomNum = Math.floor(Math.random() * 10000);

      if (senderid.trim() !== "" && text !== "") {
        messagesRef.add({
          messageid: randomNum,
          id: document.getElementById("id").innerText,
          fullname: document.getElementById("fullname").innerText,
          message: text,
          isSentByMe: false,
          date: localDate,
          time: localTime
        });
        messageInput.value = "";
      }
    }

    // Display a message
    function displayMessage(id, fullname, time, message) {
      const messagesDiv = document.getElementById("chat-messages");
      const messageElement = document.createElement("div");
      if (id == document.getElementById("id").innerText) {
        messageElement.innerHTML += `
                  <p class="name">${fullname}</p>
                  <div class="sender">
                     <p>${message}</p>
                     <span class="time">${time}</span>
                  </div>
        `;
      } else {
        messageElement.innerHTML += `
                 <div>
                  <p class="name">${fullname}</p>
                  <div class="receiver">
                     <p>${message}</p>
                     <span class="time">${time}</span>
                  </div>
               </div>
        `;
      }
      messagesDiv.appendChild(messageElement);
      messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }
