const express = require("express");
const app = express();
const mongoose = require("mongoose");
// Connect to MongoDB Atlas
mongoose.connect("mongodb+srv://ivancarito2002:Carito2020@cluster0.qpf78xw.mongodb.net/IMS?retryWrites=true&w=majority");
// Create a user model
const User = mongoose.model("user", {
  username: String,
  password: String,
});
// Handle the login form submission
app.post("/login", (req, res) => {
  const { username, password } = req.body;
  // Find the user in the database
  User.findOne({ username }, (err, user) => {
    if (err) {
      return res.status(500).send("Error finding user");
    }
    if (!user) {
      return res.status(401).send("Invalid username or password");
    }
    // Check the password
    if (user.password !== password) {
      return res.status(401).send("Invalid username or password");
    }
    // Login the user
    req.session.user = user;
    res.redirect("/");
  });
});
// Start the server
app.listen(3000, () => console.log("Server started on port 3000"));