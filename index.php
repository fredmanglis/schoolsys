<?php

session_start();

require_once( "PHP.Classes/User.class.php" );
require_once( "PHP.Classes/Employee.class.php" );
require_once( "PHP.Classes/Student.class.php" );
require_once( "PHP.Classes/Subject.class.php" );
require_once( "PHP.Classes/Stream.class.php" );
require_once( "PHP.Classes/Test.class.php" );

require_once( "PHP.Templates/ListEmptyTemplate.class.php" );
require_once( "PHP.Templates/MissingTargetTemplate.class.php" );


{	// Data

	$testTypes = Array( "CAT", "exam" );

	$template = null;

	$output = '';

	$htmlDir = __DIR__ . "/html/";

}

if( isset( $_SESSION[ "user" ][ "loggedIn" ] ) ) {
	require_once( "PHP.Templates/IndexTemplate.class.php" );
	$template = new IndexTemplate($htmlDir."index.html", $htmlDir."nav.html");

	$section = "home";

	if( isset( $_REQUEST[ "section" ] ) ) {

		$section = $_REQUEST[ "section" ];

		switch( $section ) {

			case "students" : {

				$action = "list";

				if( isset( $_REQUEST[ "action" ] ) ) {

					$action = $_REQUEST[ "action" ];

				}

				switch( $action ) {

					case "add" : {

						$stage = "1";

						if( isset( $_REQUEST[ "stage" ] ) ) {

							$stage = $_REQUEST[ "stage" ];

						}

						switch( $stage ) {

							case "2" :
							case "final" : {

								$student = new Student( "00000", $_POST[ "surname" ], $_POST[ "otherNames" ], $_POST[ "schoolID" ], $_POST[ "KCPEScore" ], $_POST[ "dateOfAdmission" ], $_POST[ "yearOfStudyAtAdmission" ], $_POST[ "gender" ] );

								if( $student -> save() ) {
									require_once("PHP.Templates/SaveStudentTemplate.class.php");
									$template = new SaveStudentTemplate($htmlDir."save_student_success.html", $htmlDir."nav.html", $student);
								}
								else {
									require_once("PHP.Templates/SaveStudentTemplate.class.php");
									$template = new SaveStudentTemplate($htmlDir."save_student_fail.html", $htmlDir."nav.html");
								}

							}
							break;

							case "1" :
							default : {
								require_once( "PHP.Templates/AddStudentTemplate.class.php" );
								$template = new AddStudentTemplate($htmlDir."add_edit_student.html", $htmlDir."nav.html");
							}
							break;

						}

					}
					break;

					case "edit" : {

						if( isset( $_REQUEST[ "target" ] ) ) {

							$target = $_REQUEST[ "target" ];

							$student = New Student( $target );

							$stage = "1";

							if( isset( $_REQUEST[ "stage" ] ) ) {

								$stage = $_REQUEST[ "stage" ];

							}

							switch( $stage ) {

								case "2" :
								case "final" : {

									//$student = new Student( "00000", $_POST[ "surname" ], $_POST[ "otherNames" ], $_POST[ "schoolID" ], $_POST[ "dateOfBirth" ], $_POST[ "dateOfAdmission" ], $_POST[ "yearOfStudyAtAdmission" ], $_POST[ "gender" ] );

									$student -> setSurName( $_POST[ "surname" ] );
									$student -> setOtherNames( $_POST[ "otherNames" ] );
									$student -> setSchoolID( $_POST[ "schoolID" ] );
									//$student -> setDateOfBirth( $_POST[ "dateOfBirth" ] );
									$student -> setDateOfAdmission( $_POST[ "dateOfAdmission" ] );
									$student -> setGender( $_POST[ "gender" ] );
									$student -> setYearOfStudyAtAdmission( $_POST[ "yearOfStudyAtAdmission" ] );

									require_once("PHP.Templates/SaveStudentTemplate.class.php");
									if( $student -> update() ) {
										$template = new SaveStudentTemplate($htmlDir."save_student_success.html", $htmlDir."nav.html", $student);
									}
									else {
										$template = new SaveStudentTemplate($htmlDir."save_student_fail.html", null);
									}

								}
								break;

								case "1" :
								default : {
									require_once("PHP.Templates/EditStudentTemplate.class.php");
									$template = new EditStudentTemplate($htmlDir."edit_student_form.html", $htmlDir."nav.html");
								}
								break;

							}

						}
						else {
							$template = new MissingTargetTemplate($htmlDir."missing_target.html", $htmlDir."nav.html");
						}

					}
					break;

					case "view" : {

						if( isset( $_REQUEST[ "target" ] ) ) {

							$target = $_REQUEST[ "target" ];

							$student = New Student( $target );

							require_once("PHP.Templates/ViewStudentTemplate.class.php");
							$template = new ViewStudentTemplate($htmlDir."view_student.html", $htmlDir."nav.html");
						}
						else {
							$template = new MissingTargetTemplate($htmlDir."missing_target.html", $htmlDir."nav.html");
						}

					}
					break;

					case "list" :
					default : {

						$students = getStudents( "all" );

						if( count( $students ) > 0 ) {
							require_once( "PHP.Templates/ListStudentsTemplate.class.php" );
							$template = new ListStudentsTemplate($htmlDir."list_students.html", $htmlDir."nav.html", $students);
						}
						else {
							$template = new ListEmptyTemplate($htmlDir."list_empty.html", $htmlDir."nav.html");
						}

					}
					break;

				}

			}
			break;

			case "employees" : {

				$action = "list";

				if( isset( $_REQUEST[ "action" ] ) ) {

					$action = $_REQUEST[ "action" ];

				}

				switch( $action ) {

					case "list" :
					default : {

						$employees = getEmployees( "all" );

						if( count( $employees ) > 0 ) {
							// TODO: use list_employees.html
							$template = new ListEmployeesTemplate($htmlDir."list_employees.html");
						}
						else {
							// TODO: use list_empty.html
							$template = new ListEmptyTemplate($htmlDir."list_empty.html");
						}

					}
					break;

				}

			}
			break;

			case "teachers" : {

				$action = "list";

				if( isset( $_REQUEST[ "action" ] ) ) {

					$action = $_REQUEST[ "action" ];

				}

				switch( $action ) {

					case "list" :
					default : {

						$teachers = getEmployees( "all", "teacher" );

						if( count( $teachers ) > 0 ) {
							// TODO: use list_teachers.html
							$template = new ListTeachersTemplate($htmlDir."list_teachers.html");
						}
						else {
							// TODO: use list_empty.html
							$template = new ListEmptyTemplate($htmlDir."list_empty.html");
						}

					}
					break;

				}

			}
			break;

			case "streams" : {

				$action = "list";

				if( isset( $_REQUEST[ "action" ] ) ) {

					$action = $_REQUEST[ "action" ];

				}

				switch( $action ) {

					case "add" : {

						$stage = "1";

						if( isset( $_REQUEST[ "stage" ] ) ) {

							$stage = $_REQUEST[ "stage" ];

						}

						switch( $stage ) {

							case "1" : {
								// TODO: use add_stream_form.html
								require_once("PHP.Templates/AddStreamTemplate.class.php");
								$template = new AddStreamTemplate($htmlDir."add_stream_form.html", $htmlDir."nav.html");
							}
							break;

							case "2" : {

								$stream = new Stream( "00000", $_POST[ "name" ], $_POST[ "description" ], $_POST[ "startYear" ], $_POST[ "stopYear" ] );

								if( $stream -> validate() ) {

									if( $stream -> save() ) {
										// TODO: use save_stream_success.html
										$template = new SaveStreamTemplate($htmlDir."save_stream_success.html");
									}

								}

							}
							break;

						}

					}
					break;

					case "edit" : {

						if( isset( $_REQUEST[ "target" ] ) ) {

							$target = $_REQUEST[ "target" ];

							$stream = new Stream( $target );

							$stage = "1";

							if( isset( $_REQUEST[ "stage" ] ) ) {

								$stage = $_REQUEST[ "stage" ];

							}

							switch( $stage ) {

								case "1" : {
									// TODO: use edit_stream_form.html
									$template = new EditStreamTemplate($htmlDir."edit_stream_form.html");
								}
								break;

								case "2" : {

								//	$stream = new Stream( "00000", $_POST[ "name" ], $_POST[ "description" ], $_POST[ "startYear" ], $_POST[ "stopYear" ] );

									$stream -> setName( $_POST[ "name" ] );
									$stream -> setDescription( $_POST[ "description" ] );
									$stream -> setStartYear( $_POST[ "startYear" ] );
									$stream -> setStopYear( $_POST[ "stopYear" ] );

									if( $stream -> validate() ) {

										if( $stream -> update() ) {
											// TODO: use save_stream_success.html
											$template = new SaveStreamTemplate($htmlDir."save_stream_success.html");
										}

									}

								}
								break;

							}

						}
						else {
							// TODO: use missing_target.html
							$template = new MissingTargetTemplate($htmlDir."missing_target.html", $htmlDir."nav.html");
						}

					}
					break;

					case "list" : {

						$streams = getStreams();

						if( count( $streams ) > 0 ) {
							require_once("PHP.Templates/ListStreamsTemplate.class.php");
							$template = new ListStreamsTemplate($htmlDir."list_streams.html", $htmlDir."nav.html");
						} else {
							$template = new ListEmptyTemplate($htmlDir."list_empty.html", $htmlDir."nav.html");
						}

					}
					break;

				}

			}
			break;

			case "subjects" : {

				$action = "list";

				if( isset( $_REQUEST[ "action" ] ) ) {

					$action = $_REQUEST[ "action" ];

				}

				switch( $action ) {

					case "add" : {

						$stage = "1";

						if( isset( $_REQUEST[ "stage" ] ) ) {

							$stage = $_REQUEST[ "stage" ];

						}

						switch( $stage ) {

							case "1" :
							default : {
								// TODO: use add_subject_form.html
								require_once( "PHP.Templates/AddSubjectTemplate.class.php" );
								$template = new AddSubjectTemplate($htmlDir."add_subject_form.html",$htmlDir."nav.html");
							}
							break;

							case "2" : {

								$subject = new Subject( "00000", $_POST[ "code" ], $_POST[ "name" ], $_POST[ "description" ], $_POST[ "startYear" ], $_POST[ "stopYear" ] );

								if( $subject -> validate() ) {

									if( $subject -> save() ) {
										// TODO: use save_subject_success.html
										$template = new SaveSubjectTemplate($htmlDir."save_subject_success.html");
									}

								}

							}
							break;

						}

					}
					break;

					case "list" : {
						// TODO: use list_subjects.html
						require_once("PHP.Templates/ListSubjectsTemplate.class.php");
						$template = new ListSubjectsTemplate($htmlDir."list_subjects.html", $htmlDir."nav.html");
					}
					break;


					case "edit" : {

						if( isset( $_REQUEST[ "target" ] ) ) {

							$target = $_REQUEST[ "target" ];

							$subject = new Subject( $target );

							$stage = "1";

							if( isset( $_REQUEST[ "stage" ] ) ) {

								$stage = $_REQUEST[ "stage" ];

							}

							switch( $stage ) {

								case "1" :
								default : {
									// TODO: use edit_subject_form.html
									$template = new EditSubjectTemplate($htmlDir."edit_subject_form.html");
								}
							break;

							case "2" : {

								$subject -> setCode( $_POST[ "code" ] );
								$subject -> setName( $_POST[ "name" ] );
								$subject -> setDescription( $_POST[ "description" ] );
								$subject -> setStartYear( $_POST[ "startYear" ] );
								$subject -> setStopYear( $_POST[ "stopYear" ] );

								if( $subject -> validate() ) {

									if( $subject -> update() ) {
										// TODO: use save_subject_success.html
										$template = new SaveSubjectTemplate($htmlDir."save_subject_success.html");
									}

									}

								}
								break;

							}

						}

					}
					break;

					case "view" : {}
					break;

				}

			}
			break;

			case "tests" : {

				$action = "list";

				if( isset( $_REQUEST[ "action" ] ) ) {

					$action = $_REQUEST[ "action" ];

				}

				switch( $action ) {

					case "add" : {

						$stage = "1";

						if( isset( $_REQUEST[ "stage" ] ) ) {

							$stage = $_REQUEST[ "stage" ];

						}

						switch( $stage ) {

							case "1" : {
								// TODO: use add_test_form.html
								require_once("PHP.Templates/AddTestTemplate.class.php");
								$template = new AddTestTemplate($htmlDir."add_test_form.html", $htmlDir."nav.html");
							}
							break;

							case "2" : {

								$test = new Test( "00000", $_POST[ "startDate" ], $_POST[ "type" ], $_POST[ "startYear" ], $_POST[ "stopYear" ] );

								if( $test -> validate() ) {

									if( $test -> save() ) {
										// TODO: use save_test_success.html
										$template = new SaveTestEntryTemplate($htmlDir."save_test_success.html");
									}

								}

							}
							break;

						}

					}
					break;

					case "edit" : {

						if( isset( $_REQUEST[ "target" ] ) ) {

							$target = $_REQUEST[ "target" ];

							$test = new Test( $target );

							$stage = "1";

							if( isset( $_REQUEST[ "stage" ] ) ) {

								$stage = $_REQUEST[ "stage" ];

							}

							switch( $stage ) {

								case "1" : {



								}
								break;

								case "2" : {



								}
								break;

							}

						}
						else {
							// TODO: use missing_target.html
							$template = new MissingTargetTemplate($htmlDir."missing_target.html", $htmlDir."nav.html");
						}

					}
					break;

					case "entry" : {

						$mode = "bulk";

						if( isset( $_REQUEST[ "mode" ] ) ) {

							$mode = $_REQUEST[ "mode" ];

						}

						switch( $mode ) {

							case "bulk" : {

								if( ( isset( $_REQUEST[ "yearOfStudy" ] ) ) && ( isset( $_REQUEST[ "subjectCode" ] ) ) && ( isset( $_REQUEST[ "yearSat" ] ) ) && ( isset( $_REQUEST[ "session" ] ) ) ) {

									// Get student who are in that year of study, who take that subject and also find which tests are in that year and session

								}
								else {

									// Error : please ensure all options were selected

									// TODO: use add_test_entry.html
									require_once("PHP.Templates/AddTestEntryTemplate.class.php");
									$template = new AddTestEntryTemplate($htmlDir."add_test_entry.html", $htmlDir."nav.html");

								}

							}
							break;

							case "individual" : {



							}
							break;

						}

					}
					break;

					case "list" :
					default : {

						$tests = getTests();

						if( count( $tests ) > 0 ) {
							// TODO: use list_tests.html
							require_once("PHP.Templates/ListTestsTemplate.class.php");
							$template = new ListTestsTemplate($htmlDir."list_tests.html", $htmlDir."nav.html");
						}
						else {
							// TODO: use list_empty.html
							$template = new ListEmptyTemplate($htmlDir."list_empty.html");
						}

					}
					break;

				}

			}
			break;

			case "logout" : {
				unset($_SESSION[ "user" ][ "loggedIn" ]);
				unset($_SESSION[ "user" ]);
				@session_destroy();
				header( "Location: /" );
				exit;
			}
			break;

		}

	}

}
else {

	// Not logged on, allow log in

	$section = "access";

	if( isset( $_REQUEST[ "section" ] ) ) { $section = $_REQUEST[ "section" ]; }

	switch( $section ) {

		case "access" :
		default : {

			$action = "toggle";

			if( isset( $_REQUEST[ "action" ] ) ) { $action = $_REQUEST[ "action" ]; }

			switch( $action ) {

				case "toggle" :
				default : {

					$stage = "1";

					if( isset( $_REQUEST[ "stage" ] ) ) { $stage = $_REQUEST[ "stage" ]; }

					switch( $stage ) {

						case "2" : {

							// Process the log in

							$query = '
SELECT
	COUNT(*)
FROM
	`accountDetails`
WHERE
	`status` = "1"
AND
	`screenname` = "' . ( $_POST[ "screenName" ] ) . '"
AND
	`password` = MD5( "' . ( $_POST[ "password" ] ) . '" )';


							$query2 = '
SELECT
	`uniqueID`,
	`screenName`
FROM
	`accountDetails`
WHERE
	`status` = "1"
AND
	`screenname` = "' . ( $_POST[ "screenName" ] ) . '"
AND
	`password` = MD5( "' . ( $_POST[ "password" ] ) . '" )';

							try {

								if( $result = $dbh -> query( $query ) ) {

									if( $result -> fetchColumn() == 1 ) {

										foreach( $dbh -> query( $query2 ) as $row ) {

											$_SESSION[ "user" ][ "loggedIn" ] = Array(
												  "screenName" => $row[ "screenName" ]
												, "userID" => $row[ "uniqueID" ]
											);

										}

									}

								}
								else {
									// TODO: use login_error.html
								}

							}
							catch( PDOException $e ) {

								print "Error!: " . $e -> getMessage() . "<br/>";

								die();

							}

							// Redirect
							$host = $_SERVER[ 'HTTP_HOST' ];
							$uri = rtrim( dirname( $_SERVER[ 'PHP_SELF' ] ), '/\\' );

							// If no headers are sent, send one
							if( !headers_sent() ) {

								header( "Location: http://" . $host . $uri . "/" );
								exit;

							}

						}
						break;

						case "1" :
						default : {
							require_once( "PHP.Templates/LoginTemplate.class.php" );
							$template = new LoginTemplate($htmlDir."login.html");
						}
						break;

					}

				}
				break;

			}

		}
		break;

	}

}


	$format = "html";

	if( isset( $_REQUEST[ "format" ] ) ) {

		$format = $_REQUEST[ "format" ];

	}

	switch( $format ) {

		case "ajax" : {
			$output = $template->get_ajax_output();
		}
		break;

		case "html" :
		default : {
			$output = $template->get_html_output();
		}
		break;

	}

	echo $output;

?>
