// This javascript is used for creating the tag and group elements for the website rather than manually.

var tagArray = ["Animal", "Bearded", "Big-Eared", "Blue", "Boys", "Cat or Dog",
"Eyewear", "Fairies", "Flying", "Four-legged", "Girls", "Green", "Hat-wearing", 
"Jewelry", "Orange", "Outer Space", "Pixar", "Prince", "Princesses", "Purple",
"Red", "Scary", "Underwater", "Yellow"];
var groupArray = ["101 Dalmatians","A Bug's Life","Aladdin","Alice in Wonderland","Bambi","Beauty and the Beast",
"Big Hero 6","Brave","Cars", "Christmas Carol", "Cinderella", "Coco","Darkwing Duck","Descendants","DuckTales","Dumbo", "Encanto", "Enchanted",
"Fantasia","Finding Nemo-Dory","Frozen","Gargoyles","Goofy Movie", "Haunted Mansion","Hercules","Hocus Pocus",
"Hunchback of Notre Dame","Inside Out","Journey Into Imagination", "Jungle Cruise", "Kingdom Hearts","Lady and the Tramp","Lilo and Stitch", "Luca",
"Mary Poppins","Matterhorn Bobsleds","Mickey and Friends", "Mickey's Christmas Carol", "Moana","Monsters Inc.","Mulan","Nightmare Before Christmas",
"Onward","Oswald the Lucky Rabbit","Peter Pan","Pinocchio","Pirates of the Caribbean","Pocahontas","Princess and the Frog",
"Ratatouille","Raya and the Last Dragon","Rescue Rangers","Robin Hood","Sleeping Beauty","Snow White", "Soul", "Star Wars",
"Tangled","The Adventures of Ichabod and Mr. Toad","The Aristocats","The Emperor's New Groove","The Incredibles",
"The Jungle Book","The Lion King","The Little Mermaid","The Muppets","The Rescuers","The Sword in the Stone",
"Three Caballeros","Toy Story","Up","WALL-E","Winnie the Pooh","Wreck-It Ralph","Zootopia"];
var powerArray = ["Add Time", "Clear Emoji", "Create Lightning", "Create Stars", "Create Suns", "Drop Items", "Generate Coins", "Rearrange Emojis", "Transform Emojis", "Trigger Blitz"];
for (var i = 0; i < tagArray.length; i++){
    var tag = tagArray[i];

    for (var j = 1; j <= 3; j++){
        var tagElement = document.createElement("option");
        tagElement.text = tag;
        tagElement.value = tag;
        document.getElementById("cat" + j).appendChild(tagElement);
    }

}
for (var i = 0; i < groupArray.length; i++){
    var group = groupArray[i];
    var groupElement = document.createElement("option");
    groupElement.text = group;
    groupElement.value = group;
    document.getElementById("Group").appendChild(groupElement);
}

for (var i = 0; i < powerArray.length; i++){
    var tag = powerArray[i];

    for (var j = 1; j <= 3; j++){
        var tagElement = document.createElement("option");
        tagElement.text = tag;
        tagElement.value = tag;
        document.getElementById("power" + j).appendChild(tagElement);
    }

}