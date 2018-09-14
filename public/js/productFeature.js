function showFeatureDiv(featuress) {
    let featureId = document.getElementById("featureName").value;
    let select = document.getElementById("featureValue");
    let features = JSON.parse(featuress);
    let featureValues = [];

    // console.log(features);
    features.forEach(item => {
        if (item.parent == featureId) featureValues.push(item);
    });

    if (featureValues.length == 0) {
        alert(
            "The Current Selection has no Child Values, Kindly Fill in the values in the Product features Section then try again."
        );
        return;
    }

    featureValues.forEach(item => {
        select.options[select.options.length] = new Option(item.name, item.id);
    });

    document.getElementById("featureForm").style.display = "block";
}
