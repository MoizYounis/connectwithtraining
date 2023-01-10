@extends('front.layouts.master')
@section('title')Interview Question | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>Interview Question</h2>
    </div>
</section>

<section class="question">
    <div class="container">
        <div class="interview">
            <h2>Interview Questions</h2>
        </div>
        <div class="common_question">
            <div class="question_tab">
                <div class="tab" id="show-me">
                  <button class="tablinks" onclick="openCity(event, 'common')">01. Common Questions <span><i class="fa fa-caret-right" aria-hidden="true"></i></span></button>
                  <button class="tablinks" onclick="openCity(event, 'oddball')">02. Oddball Questions <span><i class="fa fa-caret-right" aria-hidden="true"></i></span></button>
                  <button class="tablinks" onclick="openCity(event, 'most')">03. Most Likely Questions <span><i class="fa fa-caret-right" aria-hidden="true"></i></span></button>
                  <button class="tablinks" onclick="openCity(event, 'ask')">04. Ask The Interviewer <span><i class="fa fa-caret-right" aria-hidden="true"></i></span></button>
                  <button class="tablinks" onclick="openCity(event, 'today')">05. Hiring Today <span><i class="fa fa-caret-right" aria-hidden="true"></i></span></button>
                  <button class="tablinks" onclick="openCity(event, 'ace')">06. How To Ace An Interview <span><i class="fa fa-caret-right" aria-hidden="true"></i></span></button>
                </div>
            </div>
            <div class="question-sidebar">
                <div class="question_header">
                    <p>Specific Qualities Required</p>
                </div>
                <div class="ability">
                    <ul>
                        <li>Ability to take directions</li>
                        <li>Positive, Procative Attitude</li>
                        <li>Productivity</li>
                        <li>Flexibility</li>
                        <li>Intergrity and Honestly</li>
                        <li>Teamwork style</li>
                        <li>loyalty</li>
                        <li>Willingness to learn</li>
                        <li>Initiative</li>
                        <li>Willingness to help</li>
                        <li>Time management skills</li>
                        <li>Problem Solving Skills</li>
                        <li>Decision Making</li>
                        <li>Goal Setting</li>
                        <li>Motivation Level and Energy</li>
                        <li>Stress Management</li>
                        <li>Creativity</li>
                        <li style="border: none;">leadership abilities & style</li>
                    </ul>
                </div>
                 <div class="question_header">
                    <p>Specific Qualities Required</p>
                </div>
            </div>
        </div>
        <div class="question_tab_section">
            <div class="radio-slider">
                <div class="radio-heading">
                    <input type="radio" name='test' id='r1' checked >
                    <label>Common <br>Questions</label>
                </div>
                <div class="radio-heading">
                    <input type="radio" name='test' id='r2' >
                    <label>Oddball<br> Questions</label>
                </div>
                <div class="radio-heading">
                    <input type="radio" name='test' id='r3' >
                    <label>Most Likely<br> Questions</label>
                </div>
                <div class="radio-heading">
                    <input type="radio" name='test' id='r4' >
                    <label>Ask The <br>Interviewer</label>
                </div>
                <div class="radio-heading">
                    <input type="radio" name='test' id='r5' >
                    <label>Hiring<br> Today</label>
                </div>
                <div class="radio-heading">
                    <input type="radio" name='test' id='r6' >
                    <label>How <br>To Ace An<br>Interview</label>
                </div>
            </div>
            
            
                <div class="tabcontent common_tab" id="common" style="display:block;">
                    <h3>Common Questions and Answers</h3>
                    <div class="interviewer_questions">
                        <p><b>1. Can you tell me a little about yourself?</b><br>
                           This question seems simple, so many people fail to prepare for it, but it's crucial. Here's the deal: Don't give your complete employment (or personal) history. Instead give a pitch—one that’s concise and compelling and that shows exactly why you’re the right fit for the job. Start off with the 2-3 specific accomplishments or experiences that you most want the interviewer to know about, then wrap up talking about how that prior experience has positioned you for this specific role.<br>
                           <a href="">Read More</a>
                        </p>
                        <p><b>2. How did you hear about the position?</b><br>
                           Another seemingly innocuous interview question, this is actually a perfect opportunity to stand out and show your passion for and connection to the company. For example, if you found out about the gig through a friend or professional contact, name drop that person, then share why you were so excited about it. If you discovered the company through an event or article, share that. Even if you found the listing through a random job board, share what, specifically, caught your eye about the role.<br>
                           <a href="">Read More</a>
                        </p>
                        <p><b>3. What do you know about the company?</b><br>
                           Any candidate can read and regurgitate the company’s “About” page. So, when interviewers ask this, they aren't necessarily trying to gauge whether you understand the mission—they want to know whether you care about it. Start with one line that shows you understand the company's goals, using a couple key words and phrases from the website, but then go on to make it personal. Say, “I’m personally drawn to this mission because…” or “I really believe in this approach because…” and share a personal example or two.<br>
                           <a href="">Read More</a>
                        </p>
                        <p><b>4. Why do you want this job?</b><br>
                           Again, companies want to hire people who are passionate about the job, so you should have a great answer about why you want the position. (And if you don't? You probably should apply elsewhere.) First, identify a couple of key factors that make the role a great fit for you (e.g., “I love customer support because I love the constant human interaction and the satisfaction that comes from helping someone solve a problem"), then share why you love the company (e.g., “I’ve always been passionate about education, and I think you guys are doing great things, so I want to be a part of it”).<br>
                           <a href="">Read More</a>
                        </p>
                        <p><b>5. Why should we hire you?</b><br>
                           This interview question seems forward (not to mention intimidating!), but if you're asked it, you're in luck: There's no better setup for you to sell yourself and your skills to the hiring manager. Your job here is to craft an answer that covers three things: that you can not only do the work, you can deliver great results; that you'll really fit in with the team and culture; and that you'd be a better hire than any of the other candidates.<br>
                           <a href="">Read More</a>
                        </p>
                        <p><b>6. What are your greatest professional strengths?</b><br>
                           When answering this question, interview coach Pamela Skillings recommends being accurate (share your true strengths, not those you think the interviewer wants to hear); relevant (choose your strengths that are most targeted to this particular position); and specific (for example, instead of “people skills,” choose “persuasive communication” or “relationship building”). Then, follow up with an example of how you've demonstrated these traits in a professional setting.<br>
                           <a href="">Read More</a>
                        </p>
                        <p><b>7. What do you consider to be your weaknesses?</b><br>
                           What your interviewer is really trying to do with this question—beyond identifying any major red flags—is to gauge your self-awareness and honesty. So, “I can't meet a deadline to save my life” is not an option—but neither is “Nothing! I'm perfect!” Strike a balance by thinking of something that you struggle with but that you’re working to improve. For example, maybe you’ve never been strong at public speaking, but you've recently volunteered to run meetings to help you be more comfortable when addressing a crowd.<br>
                           <a href="">Read More</a>
                        </p>
                        <p><b>8. What is your greatest professional achievement?</b><br>
                           Nothing says “hire me” better than a track record of achieving amazing results in past jobs, so don't be shy when answering this interview question! A great way to do so is by using the S-T-A-R method: Set up the situation and the task that you were required to complete to provide the interviewer with background context (e.g., “In my last job as a junior analyst, it was my role to manage the invoicing process”), but spend the bulk of your time describing what you actually did (the action) and what you achieved (the result). For example, “In one month, I streamlined the process which saved my group 10 man-hours each month and reduced errors on invoices by 25%.”<br>
                           <a href="">Read More</a>
                        </p>
                    </div>
                </div>
                <div class="tabcontent oddball_tab" id="oddball">
                    <h3>Top Oddball Questions</h3>
                    <p>Job candidates must be prepared for anything during an interview. That's why Glassdoor has combed through hundreds of thousands of interview questions shared by job candidates over the past year to compile its annual list of the Top 10 Oddball Interview Questions.</p>
                    <div class="interviewer_questions">
                        <p><span class="num-circle">01</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">02</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">03</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">04</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">05</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">06</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">07</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">08</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">09</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">10</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">11</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">12</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">13</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">14</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">15</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">16</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">17</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">18</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">19</span> “When a hot dog expands, in which directions does it split and why?”</p>
                        <p><span class="num-circle">20</span> “When a hot dog expands, in which directions does it split and why?”</p>
                    </div>
                </div>
                <div class="tabcontent most_tab" id="most">
                    <h3>Most Likely Questions</h3>
                    <div class="interviewer_questions points">
                        <p>1. What are your strengths?</p>
                        <p>2. What are your weaknesses?</p>
                        <p>3. Why are you interested in working for [insert company name here]?</p>
                        <p>4. Where do you see yourself in five years? Ten years?</p>
                        <p>5. Why do you want to leave your current company?</p>
                        <p>6. Why was there a gap in your employment between [insert date] and [insert date]?</p>
                        <p>7. What can you offer us that someone else can not?</p>
                        <p>8. What are three things your former manager would like you to improve on?</p>
                        <p>9. Are you willing to relocate?</p>
                        <p>10. Are you willing to travel?</p>
                        <p>11. Tell me about an accomplishment you are most proud of.</p>
                        <p>12. Tell me about a time you made a mistake.</p>
                        <p>13. What is your dream job?</p>
                        <p>14. How did you hear about this position?</p>
                        <p>15. What would you look to accomplish in the first 30 days/60 days/90 days on the job?</p>
                        <p>16. Discuss your resume.</p>
                        <p>17. Discuss your educational background.</p>
                        <p>18. Describe yourself.</p>
                        <p>19. Tell me how you handled a difficult situation.</p>
                        <p>20. Why should we hire you?</p>
                        <p>21. Why are you looking for a new job?</p>
                        <p>22. Would you work holidays/weekends?</p>
                        <p>23. How would you deal with an angry or irate customer?</p>
                        <p>24. What are your salary requirements?</p>
                        <p>25. Give a time when you went above and beyond the requirements for a project.</p>
                        <p>26. Who are our competitors?</p>
                        <p>27. What was your biggest failure?</p>
                        <p>28. What motivates you?</p>
                        <p>29. What’s your availability?</p>
                        <p>30. Who’s your mentor?</p>
                        <p>31. Tell me about a time when you disagreed with your boss.</p>
                        <p>32. How do you handle pressure?</p>
                        <p>33. What is the name of our CEO?</p>
                        <p>34. What are your career goals?</p>
                        <p>35. What gets you up in the morning?</p>
                        <p>36. What would your direct reports say about you?</p>
                        <p>37. What were your bosses’ strengths/weaknesses?</p>
                        <p>38. If I called your boss right now and asked him what is an area that you could improve?</p>
                        <p>39. Are you a leader or a follower?</p>
                        <p>40. What was the last book you’ve read for fun?</p>
                        <p>41. What are your co-worker pet peeves?</p>
                        <p>42. What are your hobbies?</p>
                        <p>43. What is your favorite website?</p>
                        <p>44. What makes you uncomfortable?</p>
                        <p>45. What are some of your leadership experiences?</p>
                        <p>46. How would you fire someone?</p>
                        <p>47. What do you like the most and least about working in this industry?</p>
                        <p>48. Would you work 40+ hours a week?</p>
                        <p>49. What questions haven’t I asked you?</p>
                        <p>50. What questions do you have for me?</p>
                    </div>
                </div>
                <div class="tabcontent ask_tab" id="ask" >
                      <h3>Ask the Interviewer</h3>
                      <div class="interviewer_questions">
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> Can you tell me more about the day-to-day responsibilities of this job?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> What do you think are the most important qualities for someone to excel in this role?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> What are your expectations for this role during the first 30 days, 60 days, year?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> Describe the culture of the company.</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> Where do you think the company is headed in the next 5 years?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> Who do you consider your top competitor, and why?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> What are the biggest opportunities facing the company/department right now?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> What are the biggest challenges facing the company/department right now?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> What do you like best about working for this company?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> What is the typical career path for someone in this role?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> What are the next steps in the interview process?</p>
                        <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> How do I compare with the other candidates you’ve interviewed for this role?</p>
                      </div>
                </div>
                <div class="tabcontent today_tab" id="today">
                    <h3>Hiring Today</h3>
                      <div class="interviewer_questions">
                        <p>1. Tell me about yourself.</p>
                        <p>2. Where are you currently working?</p>
                        <p>3. Where are you currently working?</p>
                        <p>4. What do you bring to the companies you have worked for?</p>
                        <p>5. How many times in the last eight years have you met or exceeded quota?</p>
                        <p>6. Describe a tough customer that you won over. How did you do it?</p>
                        <p>7. Describe  a typical day and week for you?</p>
                        <p>8. How many cold calls do you make in a typical day?</p>
                        <p>9. What is your ratio of calls to closes?</p>
                        <p>10. How do you develop relationships with tough customers?</p>
                        <p>11. Describe some of your biggest prospecting successes?</p>
                        <p>12. Why have you been successful?</p>
                        <p>13. Tell me about a time when your persistence paid rewards?</p>
                        <p>14. Do you follow a sales system? Please describe.</p>
                        <p>15. Describe your past 3  managers. What did you like or dislike about them?</p>
                      </div>
                </div>

                <div class="tabcontent ace_tab" id="ace">
                    <h3>How to Ace An Interview</h3>
                      <div class="ace_insterview">
                        <p><span>1.</span> What does your firm look for in a candidate?</p>
                        <p><span>2.</span> How are decisions made regarding work assignments?</p>
                        <p><span>3.</span> What is the attorney/summer clerk evaluation process?</p>
                        <p><span>4.</span> Are summer associates ever made permanent offers?</p>
                        <p><span>5.</span> To whom will I report?</p>
                        <p><span>6.</span> How would you describe the "personality/culture" of this organization?</p>
                        <p><span>7.</span> In what ways do you anticipate your business growing?</p>
                        <p><span>8.</span> In which departments do you anticipate the greatest growth during the next 5 years?</p>
                        <p><span>9.</span> When will I begin to have client contact?</p>
                        <p><span>10.</span> Do most associates achieve their billable hour target? </p>
                        <p><span>11.</span> What activities are firm members involved in that are not law related?</p>
                        <p><span>12.</span> For what reasons were summer clerks not extended offers?</p>
                        <p><span>13.</span> Can I participate in pro bono activities over the summer?</p>
                        <p><span>14.</span> Does the firm have a training/rotation/mentoring program for new attorneys?</p>
                        <p><span>15.</span> What does the interviewer like about the firm, the practice of law or life in the city?</p>
                      </div>
                </div>

        </div>
        
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function (){ 
        $("#r1").click(function(){
            $(".common_tab:hidden").show('slow');
            $(".oddball_tab").hide();
            $(".most_tab").hide();
            $(".ask_tab").hide();
            $(".today_tab").hide();
            $(".ace_tab").hide();
        });
        
        $("#r1").click(function(){
            if($('r1').prop('checked')===false){
                $('#r1').hide();
            }
        });
  
        $("#r2").click(function(){
            $(".oddball_tab:hidden").show('slow');
            $(".common_tab").hide();
            $(".most_tab").hide();
            $(".ask_tab").hide();
            $(".today_tab").hide();
            $(".ace_tab").hide();
        });
    
        $("#see-me").click(function(){
            if($('see-me').prop('checked')===false){
                $('#see-me').hide();
            }
        });
  
  
        $("#r3").click(function(){
            $(".most_tab:hidden").show('slow');
            $(".common_tab").hide();
            $(".oddball_tab").hide();
            $(".ask_tab").hide();
            $(".today_tab").hide();
            $(".ace_tab").hide();
        });
       
        $("#r3").click(function(){
            if($('r3').prop('checked')===false){
                $('#r3').hide();
            }
        });
    
        $("#r4").click(function(){
            $(".ask_tab:hidden").show('slow');
            $(".common_tab").hide();
            $(".oddball_tab").hide();
            $(".today_tab").hide(); 
            $(".most_tab").hide();
            $(".ace_tab").hide();
        });
       
        $("#r4").click(function(){
            if($('r4').prop('checked')===false){
                $('#r4').hide();
            }
        });
    
        $("#r5").click(function(){
            $(".today_tab:hidden").show('slow');
            $(".common_tab").hide();
            $(".oddball_tab").hide();
            $(".most_tab").hide();
            $(".ask_tab").hide();
            $(".ace_tab").hide();
        });
       
        $("#r5").click(function(){
            if($('r5').prop('checked')===false){
                $('#r5').hide();
            }
        });
    
        $("#r6").click(function(){
            $(".ace_tab:hidden").show('slow');
            $(".common_tab").hide();
            $(".oddball_tab").hide();
            $(".today_tab").hide();
            $(".most_tab").hide();
            $(".ask_tab").hide();
        });
       
        $("#r6").click(function(){
            if($('r6').prop('checked')===false){
                $('#r6').hide();
            }
        });
    });
</script>   
<script>
    
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

@endsection