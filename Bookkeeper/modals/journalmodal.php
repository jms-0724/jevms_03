
   <!-- Add Journal Preparation 1 -->
<div class="modal fade" id="createJournals1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addJournalEntryForm">
                <div class="form-group mb-2">

                <label for="add_journal_number" class="form-label">Journal Number</label>
                <input type="text" name="add_journal_number" id="add_journal_number" class="form-control">
                    
                </div>
                <div class="form-group mb-2">
                    <label for="add_journal_description" class="form-label">Journal Description</label>
                    <input class="form-control"  rows="3" id="add_journal_description" list="J_Desc"></input>
                    <datalist id="J_Desc">
                        
                    </datalist>
                </div>
                <div class="form-group mb-3">
                    <label for="userlevel" class="form-label">Journal Category</label>
                            <select name="account_category" id="add_journal_category" class="form-select" required>
                               
                            </select>
                </div>
                
                
               
                <div class="form-group">
                    <button type="button" class="btn btn-primary"  id="nextJItems">Next</button>
                </div>

                </div>


                <div class="modal-footer">
                    <div class="d-flex mt-3 mx-3 border">
                    <!-- <button type="submit" class="btn btn-primary">Save Entry</button> -->
                        <button type="reset" class="btn btn-danger">Clear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                
            </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Add Journal Modal 2 -->
<div class="modal fade" id="createJournals2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addJournalEntryForm2">
                <div class="form-group mb-2">
                    <label for="account_journal_title" class="form-label">Account Titles</label>
                    <select name="account_journal_title" id="add_journal_title" class="form-select" required>
                      
                    </select>   
                </div> 

                <div class="form-group mb-3">
                    <label for="add_journal_number" class="form-label">Amount Entered</label>
                    <input type="number" name="add_journal_amount" id="add_journal_amount" class="form-control">
                </div>
                
                                
                <div class="form-group my-3">
                <button type="button" id="addJEntry" class="btn btn-primary">Normal Balance Entry</button>
                <button type="button" id="addJEntry2" class="btn btn-primary">Contra Balance Entry</button>
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead class="table table-bordered table-primary">
                            <th>Account Code</th>
                            <th>Account Title</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Actions</th>

                        </thead>
                        <tbody id="journalBody" class="table table-bordered">
                        
                        </tbody>
                        <tfoot class="table table-warning table-bordered">
                          <tr class="">
                            <th colspan="2">Total</th>
                            <th id="Dr"></th>
                            <th id="Cr"></th>
                          <td></td>
                          </tr>
                            
                        </tfoot>
                    </table>
                </div>

                </div>

                <div class="d-flex modal-footer">
                    <div class="d-flex mt-3 mx-3 border">
                    <!-- <button type="submit" class="btn btn-primary">Save Entry</button> -->
                        <button type="button" class="btn btn-primary" id="saveEntry">Save Entry</button>
                        <button type="reset" class="btn btn-danger">Clear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                
            </form>
        </div>
      </div>
    </div>
  </div>

     <!-- View Journal Preparation 1 -->
<div class="modal fade" id="viewEntry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">View Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          

          <div class="d-flex">
            <p>JEV Number: <span id="jevNum"> </span></p>
          </div>
          <div class="d-flex">
            <p>Date Created: <span id="jevDate"> </span></p>
          </div>
          <div class="d-flex">
            <p>Journal Category: <span id="jevType"></span></p>
          </div>
                <table class="table">
                    <thead>
                        <th>Account Code</th>
                        <th>Account Name</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </thead>
                    <tbody id="viewJTable">
                        
                    </tbody>
                    <tfoot class="table table-primary">
                      <tr class="">
                        <td colspan="2">Total</td>
                        <td id="Dr2"></td>
                        <td id="Cr2"></td>
                      </tr>
                    </tfoot>
                    
                </table>
                <div>
                  <a href="" id="printJEV1" class="btn btn-primary" target="_blank">Print</a>
                </div>
        </div>
      </div>
    </div>
  </div>

       <!-- Edit Journal Preparation 1 -->
<div class="modal fade" id="editEntry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editTabularData">
            <div class="form-group">
                <label for="">Amount</label>
                <input type="number" name="jevAmount" id="jevAmount" class="form-control">
            </div>
          </form>
          <div class="d-flex modal-footer">
            <div class="d-flex mt-3 mx-3 border">
                    <!-- <button type="submit" class="btn btn-primary">Save Entry</button> -->
                <button type="button" class="btn btn-primary" id="saveEdit">Save Entry</button>
                <button type="reset" class="btn btn-danger">Clear</button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createJournals2">Back</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>