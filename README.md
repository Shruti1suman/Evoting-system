## Evoting System (Group Project) 
#Overview  
The Evoting System is a secure and user-friendly platform that allows administrators to manage elections, candidates, and voters efficiently. Voters can register, log in, and cast their votes in a seamless and secure environment. The system supports multiple features to enhance the voting process, ensuring transparency, accessibility, and ease of use.   

# Features  
- Admin Panel  
- Election Management: Create,and delete elections.  
- Candidate Management: Add and remove candidates for each election.  
- Adding new Voter : Approve Voters application.
- Approving voter's request for editing their details.

- Election Analytics: View election results, voter turnout, and detailed reports after election.
  
- Voter Panel  
- Voter Registration: Voters can self-register, subject to admin approval.  
- Secure Login: Voters log in securely after being approved by the admin.  
- Voting: Cast votes in available elections with a simple and intuitive interface.  
- Voter Dashboard: View upcoming elections, and enable voter to vote the candidates of elections.

  🔗 Live Demo
   [Click me to see the app!](http://shrutivotes.infinityfreeapp.com/)

## 🛠️ Technologies Used

- HTML, CSS, JavaScript (Frontend)
- PHP (Backend)
- MySQL (Database)
- InfinityFree (Hosting)
  
## 📦 Installation

To run this project locally:

1. **Clone or download the repository.**
2. Copy the project files into your web server's root directory. If using XAMPP, place it inside the `htdocs` folder.
3. Import the database:
   - Open phpMyAdmin
   - Create a database named `evoting` (or your preferred name)
   - Import the provided `.sql` file into the database
4. Update your database connection in `config.php`:
   ```php
   $conn = mysqli_connect("localhost", "root", "", "evoting");

  ## 📦 Usage
  
# Admin role :
- Click on Login and choose to Login as Admin.
- Fill Admin ID as "Admin" and Password as "admin156"          (!!! IMPORTANT !!!)
- Add Election and create new election with valid dates.
- Add Candidates for new Election.
- Add Voters with validating the details with eligibility of voting.
- Check if any voter has requested for there voter ID updates.
- Admin can delete Election, Candidate or Voter.

  # Voter role :
  - After installing the project, User get the access of Homepage.
  - Click o Apply for registering as new voter.
  - Fill the required informations for Voter.
  - Check the Voter List from Navbar of homepage frequently.
  - Get voter ID if approved by the Admin.
  - Use Voter ID and Password for login as Voter.
  - Get the Elections to be voted in on Voter Panel.
  - Choose Candidate to be voted for and Do Vote.
  - Wait for Election to be ended and See the result on homepage.
 
    ## Documentation :
   - [Link!]( https://drive.google.com/file/d/1--11PHXnJ2Ml0ZNBaPSH5Zn6qquwzwbA/view?usp=sharing)
 
 
    ## Contribution :

  - Added the feature for Applying as new Voter.
  - Requesting an update in existing voter Id details.
  - Admin approving new Voter and update request.
  - Declaring result for Elections.
  - Viewing result report in Votes no. and percentage to each candidate.

 
  ## 🧑‍💻 Author :
  
    Shruti Suman
