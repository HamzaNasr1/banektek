function creditscoring($age,$apport_propre,$revenu_mensuel,$duree,$montant,$taux,$mensualite,$solde,$revenu_bancaire){
    var minScore = Infinity; // Initialiser à une valeur très grande

    function calculateScore(ageCoeff, apportCoeff, revenuCoeff, montantCoeff, revenuBancaireCoeff) {
        var score = 0;

        //calcul score age////////////////////////////
        if($age < 25){
            score += 5 * ageCoeff;
        } else if($age < 30){
            score += 4 * ageCoeff;
        } else if($age < 35){ 
            score += 3 * ageCoeff;
        } else if($age < 40){
            score += 2 * ageCoeff;
        } else if($age < 45){ 
            score += 1 * ageCoeff;
        } else if($age < 50){
            score += 0 * ageCoeff;
        } else if($age < 55){
            score -= 1 * ageCoeff;
        } else if($age < 60){ 
            score -= 2 * ageCoeff;
        } else if($age < 65){
            score -= 3 * ageCoeff;
        } else if($age < 70){
            score -= 4 * ageCoeff;
        } else {
            score -= 5 * ageCoeff;
        }

        //////////////////::cal c ul score apport propre////////////////////////
        if($apport_propre > $montant*0.2){
            score += 5 * apportCoeff;
        } else if($apport_propre > $montant*0.15){
            score += 4 * apportCoeff;
        } else if($apport_propre > $montant*0.1){ 
            score += 3 * apportCoeff;
        } else if($apport_propre > $montant*0.05){ 
            score += 2 * apportCoeff;
        } else if($apport_propre > $montant*0.02){ 
            score += 1 * apportCoeff;
        } else if($apport_propre > $montant*0.01){
            score += 0 * apportCoeff;
        } else if($apport_propre > $montant*0.005){ 
            score -= 1 * apportCoeff;
        } else if($apport_propre > $montant*0.002){
            score -= 2 * apportCoeff;
        } else if($apport_propre > $montant*0.001){ 
            score -= 3 * apportCoeff;
        } else if($apport_propre > $montant*0.0005){ 
            score -= 4 * apportCoeff;
        } else { 
            score -= 5 * apportCoeff;
        }

        //////////////////calcul score revenu mensuel////////////////////////
        if($revenu_mensuel > $mensualite*0.5){
            score += 5 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.4){
            score += 4 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.3){ 
            score += 3 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.2){ 
            score += 2 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.1){ 
            score += 1 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.05){
            score += 0 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.02){ 
            score -= 1 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.01){
            score -= 2 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.005){ 
            score -= 3 * revenuCoeff;
        } else if($revenu_mensuel > $mensualite*0.002){ 
            score -= 4 * revenuCoeff;
        } else { 
            score -= 5 * revenuCoeff;
        }

        // Calcul du score en fonction du montant
        if ($montant > $solde){
            score -= 2 * montantCoeff;
        } else if ($montant > $solde*0.5){
            score += 1 * montantCoeff;
        } else if ($montant > $solde*0.4){
            score += 2 * montantCoeff;
        } else if ($montant > $solde*0.3){
            score += 3 * montantCoeff;
        } else if ($montant > $solde*0.2){
            score += 4 * montantCoeff;
        } else if ($montant > $solde*0.1){ 
            score += 5 * montantCoeff;
        }

        // revenu banccaire
        if($revenu_bancaire > $montant*$taux/$duree) {
            score += 5 * revenuBancaireCoeff;
        } else if($revenu_bancaire > $montant*$taux/($duree*2)) {
            score += 3 * revenuBancaireCoeff;
        } else if($revenu_bancaire > $montant*$taux/($duree*3)) {
            score += 1 * revenuBancaireCoeff;
        } else {
            score -= 5 * revenuBancaireCoeff;
        }

        return score;
    }

    
    var scores = [];

    //coefficients
    var coefficients = [
        { age: 1, apport: 1, revenu: 1, montant: 1, revenuBancaire: 1 },
        { age: 1, apport: 2, revenu: 1, montant: 2, revenuBancaire: 1 },
        { age: 2, apport: 1, revenu: 2, montant: 1, revenuBancaire: 1 }
       
    ];

    coefficients.forEach(function(coeff) {
        var currentScore = calculateScore(coeff.age, coeff.apport, coeff.revenu, coeff.montant, coeff.revenuBancaire);
        scores.push(currentScore);
    });
    //meanScore = scores.reduce((a, b) => a + b, 0) / scores.length;
    maxScore = Math.max(...scores);
    minScore = Math.min(...scores);
  let     score_final = maxScore*0.4 + minScore*0.6;
  round_score = score_final.toFixed(0);
    return round_score;
}
//max//console.log(creditscoring(0, 1000000, 10000000, 10, 100, 0.01, 1099900, 1000000000, 1000000000)); // 0
//console.log(creditscoring(10000, 0,0, 0, 1, 10000000000, 0.1, 0, -110,-10000)); // 0