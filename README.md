# Gordon Rodseth
## 200055
# DV204 2021


The Hive
Community forum for Beekeepers and bee-enthusiasts
Explore the docs »

View Demo · Report Bug · Request Feature

## Table of Contents
### About the Project
### Project Description
### Built With
### Getting Started
### Features and Functionality
### Concept Process
### Ideation
### Wireframes
### User-flow
### Development Process
### Implementation Process
### Highlights
### Challenges
### Reviews and Testing
### Feedback from Reviews
### Unit Tests
### Final Outcome
### Mockups


### Project Description
The brief for this project was to build a forum based website which would facilitate questions, answers, upvotes, and downvotes.

### Built With
Symfony
PHP
jQuery
HTML & CSS

### Features and Functionality
#### User Sign In & Sign Up
Users of the site needed to be able to create their own accounts, sign in, sign out, and then edit their account details

#### Making/Viewing Posts
Users need to be able to post their own questions to the database and view the posts of other users from the database

#### Commenting
Users should be able to post replies to other users' posts and to other users' comments

#### Upvoting/Downvoting/Reputation
A post can be upvoted or downvoted. Each user has a "Reputation" statistic which is determined by how their posts are generally percieved.

#### Banning Users
Admins should have extra privileges over other users, allowing them to ban regular users. Banned users have restricted access to the site


### Concept Process
Working with the idea of a forum, I was drawn to the idea of a hobbyist site where members of a certain hobby could share advice and questions. Looking into popular hobbies, I found beekeeping to be an interesting, niche, subject that could be visually interesting to implement.

### Ideation
I put together a moodboard to serve as visual inspiration for my site

(not sure how to insert an image into a README)

### Wireframes
I drew up a series of wireframes to get the basic layout of the site mapped out. This gave me an idea on what elements need to be built

(not sure how to insert an image into a README)

### User-flow
The User Flow helped outline how seperate functions and features need to be linked together.

(not sure how to insert an image into a README)

### Development Process
First the necessary softwares to work with Symfony and Composer were installed.
The seperate entities of User, Post, Comment, Upvotes, and Downvotes were created and given the necessary properties through Doctrine ORM commands.
The Entity Relationships were set up. Posts were linked to Users, Comments, Upvotes, and Downvotes. Users were linked to Posts, Comments, Upvotes, and Downvotes. These relationships were set up through the Symfony framework and Doctrine ORM commands.
The front end of the site was created through basic html and css.
jQuery was used to some extent to link the back-end and the front-end

### Implementation Process
As discussed previously, Doctrine ORM commands were used for the basic set up of the code. This was used to access some useful Symfony templates which were used to define the Entities.
Symfony's tools made it easy to manage the various properties of the entities. For example, each user has a username, an email, and a password, the details of which were managed through PHP code and then migrated up to the database.
Symfony's tools were also used to manage the relationships between entities. Through this each Post was related to the User who posted it and to each Comment made under it which were similarly related to the User who made the Comment.
Symfony hosts a range of tools that made it easy to manage form submission and user management. A large part of the front end to back end connections were facilitated by these tools
The Upvoting/Downvoting system was managed through jQuery which called the Symfony code when the relevant buttons on the front end were interacted with

### Highlights
Symfony provides a toolset with lots of interesting capabilities that were very fun to explore. The way that the framework allows programmers to implement functionality straight and calls to the database straight from the html makes a lot of tasks that could be headache inducing quite simple and straight forward to implement.

### Challenges
PHP can be very difficult to work with and very frustrating to debug. This caused a lot of time to be wasted in getting basic functions to work. The time that the framework saved when working as expected only slightly outmeasures that wasted when it doesnt.

### Reviews & Testing
Peer Reviews were conducted by my fellow students and lecturer.
While a lot of feedback reflected favourably on the functionality and relative usability of my site at the time of presenting, the front end designs and the branding recieved mixed to negative responses.
A lot of work was done to attempt to make the front end more appealing in response to this.

### Final Outcome
I am proud to have created a site that is as functional and presentable as this is. There were some issues with my time management which caused the project to fall short of my in some areas. I would have liked for the UI to be a bit smoother than it turned out to be. But in the end I'm proud of the functionality that I have managed to achieve.

### Mockups
(not sure how to insert an image into a README)

### Video Demonstration
(not sure how to insert an image into a README)


Contact
Gordon Rodseth - 200055@virtualwindow.co.za

Acknowledgements
Icons provided by Google Icons https://fonts.google.com/icons
Fonts from Google Fonts https://fonts.google.com
Example user profile pictures from Unsplash
