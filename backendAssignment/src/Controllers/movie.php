<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include movieProc.php file
include __DIR__ . '../movieProc.php';

//read table movie
$app->get('/movie', function (Request $request, Response $response, array
$arg){
 return $this->response->withJson(array('data' => 'success'), 200);
});

//request table movie by condition
$app->get('/movie/[{Rank}]', function ($request, $response, $args){

    $movieRank = $args['Rank'];
    if (!is_numeric($movieRank)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);
    }
    $data = getMovie($this->db,$movieRank);
    if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 500);
   }
    return $this->response->withJson(array('data' => $data), 200);
   });
   
   //request table all movie
   $app->get('/movieall', function ($request, $response, $args){

    $data = getAllmovie($this->db);
    if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 500);
   }
    return $this->response->withJson(array('data' => $data), 200);
   });

//add movie
   $app->post('/movie/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createMovie($this->db, $form_data);
    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
   );

//delete
    $app->delete('/movie/del/[{Rank}]', function ($request, $response, $args){

    $movieRank = $args['Rank'];
  if (!is_numeric($movieRank)) {
     return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
  }
 $data = deletemovie($this->db,$movieRank);
 if (empty($data)) {
  return $this->response->withJson(array($movieRank=> 'is successfully deleted'), 202);};
 });

//update 
$app->put('/movie/put/[{Rank}]', function ($request,  $response,  $args){
    $movieRank = $args['Rank'];
    $date = date("Y-m-j h:i:s");
  
   if (!is_numeric($movieRank)) {
      return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
    $form_dat=$request->getParsedBody();
  
  $data=updatemovie($this->db,$form_dat,$movieRank);
  
  if ($data <=0)
  return $this->response->withJson(array('data' => 'successfully updated'), 200);
  });
