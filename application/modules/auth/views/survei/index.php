<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Survei</title>
    </head>
    <!-- untuk survey -->
	<style>
        .form-container_survey {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        .form-group_survey {
            margin-bottom: 15px;
        }

        .modal_survey {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content_survey {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .modal-content_survey.success {
            border-left: 5px solid #28a745;
        }
        .modal-content_survey.error {
            border-left: 5px solid #dc3545;
        }
        .close-btn_survey {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            line-height: 1;
        }
        .close-btn_survey:hover,
        .close-btn_survey:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
       
        .modal-content_survey {
            height: 80%;
            background-color: #fefefe;
            margin: 2% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 100%;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .modal-content_survey .iframe-active_survey #modalMessage {
            display: none;
        }
    </style>
	<!-- untuk survey -->

    <body>
        <div style="text-align: center; margin-top: 50px;">
           
        </div>
        <!-- modal popup untuk survey -->
        <div class='container'>
            <div id="statusModal" class="row modal_survey">
                <div class="modal-content_survey">
                    <span class="close-btn_survey">&times;</span>
                    <h3 id="modalTitle">Berikan Penilaian Terbaik Anda...</h3>
                    
                    <p id="modalMessage"></p> 
                    
                    <iframe id="resultIframe" style="width: 100%; height: inherit; border: none; display: none;" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <!-- ====================== -->

        <script>
            // untuk survey ===================
            // mulai_survey();
            setTimeout(mulai_survey, 6000);
			function mulai_survey() {
				const modal = document.getElementById('statusModal');
				const modalContent = modal.querySelector('.modal-content_survey');
				const modalTitle = document.getElementById('modalTitle');
				const resultIframe = document.getElementById('resultIframe');
				const respondentNameInput = document.getElementById('respondent_name');

                resultIframe.style.display = 'none';
                modalContent.className = 'modal-content_survey';
                modal.style.display = "block";

				modalTitle.textContent = "Berikan Penilaian Terbaik Anda...";
				
				resultIframe.src = "https://surveidigital.spbe.go.id/embed/survey/eyJzdXJ2ZXlfaWQiOjIsInNlcnZpY2VfaWQiOjM1MiwiaG9zdCI6Imh0dHBzOi8vc2ltYmFuZ2RhLnN1bWJhcnByb3YuZ28uaWQvLGh0dHA6Ly9sb2NhbGhvc3Qvc2JlXzIwMjQiLCJrZXkiOiJtS3AxUkpSbyJ9/embed/view/?jenis_layanan=SIMBANGDA BASED EVIDENCE";
				resultIframe.style.display = 'block';
				respondentNameInput.value = '';
				
				modalMessage.style.display = 'none';
				modalContent.className = 'modal-content_survey success_survey iframe-active_survey';
				modal.style.display = "block";
			}

			const modal = document.getElementById('statusModal');
			const closeBtn = modal.querySelector('.close-btn_survey');

			closeBtn.onclick = function() {
				modal.style.display = "none";
			}
			
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
			// untuk survey ===================
		</script>
    </body>
</html>