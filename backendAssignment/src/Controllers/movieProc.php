<?php
//get all movie
function getAllmovie($db)
{
    $sql = 'Select Rank , Title , Description , Runtime , Genre , Rating , Year from imdb_top_50';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //get product by Rank
    function getMovie($db, $movieRank)
    {
    $sql = 'Select Rank , Title , Description , Runtime , Genre , Rating , Year from imdb_top_50 ';
    $sql .= 'Where Rank = :Rank';
    $stmt = $db->prepare ($sql);
    $id = (int) $movieRank;
    $stmt->bindParam(':Rank', $movieRank, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //add new movie
function createMovie($db, $form_data) {
    $sql = 'Insert into imdb_top_50 (Title , Description , Runtime , Genre , Rating , Year) ';
    $sql .= 'values (:Title , :Description , :Runtime , :Genre , :Rating , :Year)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':Title', $form_data['Title']);
    $stmt->bindParam(':Description', ($form_data['Description']));
    $stmt->bindParam(':Runtime', $form_data['Runtime'], PDO::PARAM_INT);
    $stmt->bindParam(':Genre', $form_data['Genre']);
    $stmt->bindParam(':Rating', $form_data['Rating']);
    $stmt->bindParam(':Year', $form_data['Year'], PDO::PARAM_INT);
    $stmt->execute();
    return $db->lastInsertID();//insert last number.. continue
    }

    //delete movie
    function deletemovie($db,$movieRank) {
        $sql = ' Delete from imdb_top_50 where Rank = :Rank';
        $stmt = $db->prepare($sql);
        $movieRank = (int) $movieRank;
        $stmt->bindParam(':Rank', $movieRank, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    //update movie
    function updatemovie($db, $form_dat, $movieRank) {
        $sql = 'UPDATE imdb_top_50 SET Title = :Title , Description = :Description , Runtime = :Runtime , Genre = :Genre , Rating = :Rating , Year = :Year ';
        $sql .=' WHERE Rank = :Rank';
        $stmt = $db->prepare ($sql);
        $movieRank = (int) $movieRank;
    
        $stmt->bindParam(':Rank', $movieRank, PDO::PARAM_INT);
        $stmt->bindParam(':Title', $form_dat['Title']);
        $stmt->bindParam(':Description', ($form_dat['Description']));
        $stmt->bindParam(':Runtime', ($form_dat['Runtime']));
        $stmt->bindParam(':Genre', $form_dat['Genre']);
        $stmt->bindParam(':Rating', $form_dat['Rating']);
        $stmt->bindParam(':Year', $form_dat['Year'], PDO::PARAM_INT);
        $stmt->execute();
    }