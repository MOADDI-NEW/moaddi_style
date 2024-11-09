document.addEventListener("DOMContentLoaded", function () {
    const chatBotContainer = document.getElementById("chatBot");
    const chatBotToggle = document.getElementById("chatBotToggle");

    // Toggle Chatbot visibility on button click
    chatBotToggle.addEventListener("click", function () {
        if (chatBotContainer.style.display === "none") {
            chatBotContainer.style.display = "flex";
        } else {
            chatBotContainer.style.display = "none";
        }
    });

    // Your existing chatbot functions
    const chatBody = document.getElementById("chatBody");
    const userInput = document.getElementById("userInput");

    function appendBotMessage(message, options = null) {
        const containerDiv = document.createElement("div");
        containerDiv.style.display = "flex";
        containerDiv.style.alignItems = "flex-start";

        const imgElement = document.createElement("img");
        imgElement.src = "./assets/images/about/img-1.jpg";
        imgElement.alt = "Join";
        imgElement.classList.add("direct-chat-img");
        containerDiv.appendChild(imgElement);

        const messageDiv = document.createElement("div");
        messageDiv.classList.add("bot-message");
        messageDiv.innerHTML = message;
        containerDiv.appendChild(messageDiv);

        chatBody.appendChild(containerDiv);

        if (options) {
            options.forEach(option => {
                const optionElement = document.createElement("span");
                optionElement.classList.add("chat-option");
                optionElement.innerText = option.text;
                optionElement.onclick = option.handler;
                chatBody.appendChild(optionElement);
            });
        }

        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function appendUserMessage(message) {
        const messageDiv = document.createElement("div");
        messageDiv.classList.add("user-message");
        messageDiv.innerText = message;
        chatBody.appendChild(messageDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function startChat() {
        setTimeout(() => {
            appendBotMessage('Welcome to Moaddi Marketing Line -- How can we help you?', [
                { text: "■ I'm a Business Owner or Brand", handler: () => handleCompanyOwner() },
                { text: "■ I'm an Advertiser or Marketer", handler: () => handleMarketer() }
            ]);
        }, 1000);
    }

    function handleCompanyOwner() {
        appendUserMessage("Business Owner or Brand");
        setTimeout(() => {
            appendBotMessage('We are happy to provide services to Business Owners. Please choose how we can help you:', [
                { text: "■ Offers for Company Owners", handler: () => window.location.href = "brand" },
                { text: "■ Join Us Now", handler: () => window.location.href = "dashbord/" },
                { text: "■ Talk to Customer Service", handler: () => window.location.href = "contact" }
            ]);
        }, 1000);
    }

    function handleMarketer() {
        appendUserMessage("Advertiser or Marketer");
        setTimeout(() => {
            appendBotMessage('We are happy to provide services to Advertisers or Marketers. Please choose how we can help you:', [
                { text: "■ Offers for Marketers", handler: () => window.location.href = "marketing" },
                { text: '■ Join Us Now', handler: () => window.location.href = "dashbord/" },
                { text: "■ Talk to Customer Service", handler: () => window.location.href = "contact" }
            ]);
        }, 1000);
    }

    // Auto-start the chat when the chatbot is opened
    chatBotToggle.addEventListener("click", function () {
        if (chatBotContainer.style.display === "flex") startChat();
    });
});