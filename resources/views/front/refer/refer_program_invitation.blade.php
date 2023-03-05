@extends('front.layouts.master')
@section('title')Refer Program {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2>Referral Program Invitation</h2>    
        </div>
    </section>

    <section class="refer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="refer-program">
                        <p>Refer a friend promotion is always displayed on the registration page, we recommend you add an incentive - people like discounts!</p>
                    </div>
                    <div class="refer-rating">
                        <div class="refer-head">
                            <span>1</span>
                            <h2>Invite using</h2>
                        </div>
                        <div class="refer-email">
                            <div class="refer-list">
                                 <input type="checkbox" name="">
                                 <p>Refer by Email</p>
                            </div>
                            <div class="refer-list">
                                 <input type="checkbox" name="">
                                 <p>Post to Socail Media</p>
                                 <select>
                                     <option>Facebook</option>
                                     <option>Friendster</option>
                                     <option>Furl</option>
                                     <option>Google</option>
                                     <option>Hi5</option>
                                     <option>IMFaceplate</option>
                                     <option>Linkedin</option>
                                     <option>Mangolia</option>
                                     <option>Mister Wrong</option>
                                     <option>My Space</option>
                                     <option>Net Vibes</option>
                                     <option>Newsvines</option>
                                     <option>Orkut</option>
                                     <option>Pinterest</option>
                                     <option>Friend Feed</option>
                                 </select>
                            </div>
                        </div>
                        <div class="refer-head">
                            <span>2</span>
                            <h2>REFERRER</h2>
                        </div>
                        <div class="refer-prgm">
                            <p>How many friends must the registrant refer to get a discount?</p>
                            <div class="zero-one">
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>4</li>
                                    <li>5</li>
                                </ul>
                            </div>
                            <p>What discount do you want to apply to the refferrers highest priced registration?</p>
                            <div class="percent">
                                <div class="percent-drop">
                                    <select>
                                        <option>%</option>
                                    </select>
                                </div>
                                <div class="percent-drop">
                                    <select>
                                        <option>0</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="refer-head">
                            <span>3</span>
                            <h2>Friends</h2>
                        </div>
                        <div class="refer-prgm">
                            <p>How many friends must the registrant refer to get a discount?</p>
                            <div class="zero-one">
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>4</li>
                                    <li>5</li>
                                </ul>
                            </div>
                            <p>What discount do you want to apply to the refferrers highest priced registration?</p>
                            <div class="percent">
                                <div class="percent-drop">
                                    <select>
                                        <option>%</option>
                                    </select>
                                </div>
                                <div class="percent-drop">
                                    <select>
                                        <option>0</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="validate">
                        <div class="validate-head">
                            <h2>REFERRAL PROGRAM</h2>
                        </div>
                        <div class="validate-tab">
                            <main>
                              <section>
                                <div class="tab-panel">
                                  <!-- Tabs nav -->
                                  <ul>
                                    <li>
                                      <button class="tab active" data-content="#one">SPONSOR MY FRIEND</button>
                                    </li>
                                    <li>
                                      <button class="tab" data-content="#two">PENDING FRIENDS</button>
                                    </li>
                                    <li>
                                      <button class="tab" data-content="#three">FRIENDS I SPONSORED</button>
                                    </li>
                                  </ul>
                                  
                                  <!-- Tabs content -->
                                  <div id="one" class="content show">
                                      <div class="validate-dicoount">
                                          <h2>Get a discount XXXXXX XXXXXXXX XXXXXXXXXXX XXXXXXXXXXXX XXXXXXX XXXXXXXXXXXX this website.</h2>
                                          <p>It’s quick and it’s easy, XXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXX
                                            XXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXX worth $5000.</p>
                                      </div>
                                      <div class="validate-list">
                                          <div class="validate-list-head">
                                              <p>First Name</p>
                                              <p>Last Name</p>
                                              <p>E-mail</p>
                                          </div>
                                          <div class="validate-list-input">
                                              <div class="input-list bg">
                                                  <p>1.</p>
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                              </div>
                                              <div class="input-list">
                                                  <p>2.</p>
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                              </div>
                                              <div class="input-list bg">
                                                  <p>3.</p>
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                              </div>
                                              <div class="input-list">
                                                  <p>4.</p>
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                              </div>
                                              <div class="input-list bg">
                                                  <p>5.</p>
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                                  <input type="text" name="">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="validate-dicoount">
                                        <h2>Important: Your friend’s email XXXXXXXXXX XXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXX
                                        XXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXX other purposes.</h2>
                                        <div class="discount-text">
                                            <input type="checkbox" name="">
                                            <p>I agree to the terms XXXX XXXXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXX sent to your friends.</p>
                                        </div>
                                        <div class="validete-btn">
                                            <a href="">Validate</a>
                                        </div>
                                      </div>
                                  </div>
                                  <div id="two" class="content show">
                                      <p >Tab <strong>two</strong> content</p>
                                  </div>
                                  <div id="three" class="content show">
                                      <p >Tab <strong>three</strong> content</p>
                                  </div>
                                  
                                  
                                  
                                </div>
                                
                              </section>
                            </main>
                        </div>
                    </div>
                    <div class="preview-option">
                        <div class="option-head">
                            <h2>preview</h2>
                            <a href=""><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>
                        </div>
                        <div class="preview-letter">
                            <div class="letter-head">
                                <h2>INVITE YOUR FRIENDS NOW!</h2>
                            </div>
                            <div class="letter-body">
                                <p>Events are way more fun with your peeps! Invite your friends, family,
                                co-workers, anyone you want to share this experience with!</p>
                                <div class="letter-email">
                                    <div class="email-icon">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <h3>SHARE WITH EMAIL</h3>
                                    </div>
                                    <div class="email-option">
                                        <p><i class="fa fa-smile-o" aria-hidden="true"></i> Don’t worry, you’ll stay in this page!</p>
                                        <p><i class="fa fa-smile-o" aria-hidden="true"></i> We promise not to spam your friends.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="letter-btn">
                            <div class="refer-preview">
                                <a href="">Send</a>
                            </div>
                            <div class="refer-cancel">
                                <a href="">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection