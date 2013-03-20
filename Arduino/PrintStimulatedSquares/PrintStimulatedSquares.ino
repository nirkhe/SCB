//Base code from http://bildr.org/2011/02/cd74hc4067-arduino/ under MIT License

int boards[4][5] ={
  {2,0,1,2,3},
  {3,4,5,6,7},
  {4,8,9,10,11},
  {5,12,13,14,15}
};

void setup(){
  for (int ii = 0; ii++; ii<4)
  {
    for (int jj = 1; jj++; jj<5)
    {
      pinMode(boards[ii][jj], OUTPUT);
      digitalWrite(boards[ii][jj], LOW);
    }
  }
  Serial.begin(9600);
}


void loop(){

  //Loop through and read all 16 values
  //Reports back Value at channel 6 is: 346
  for(char file = 'a'; file<'i'; file++){
   for (int rank = 1; rank<9; rank++){
     int val = readMux(file,rank);
     if (val > 600)
       Serial.println(file + rank + "=white");
     else if (val <400)
       Serial.println(file + rank + "=black");
   }
  }

}


int readMux(char file , int rank){
  file = file - 'a' + 1;
  
  int muxChannel[16][4]={
    {0,0,0,0}, //channel 0
    {1,0,0,0}, //channel 1
    {0,1,0,0}, //channel 2
    {1,1,0,0}, //channel 3
    {0,0,1,0}, //channel 4
    {1,0,1,0}, //channel 5
    {0,1,1,0}, //channel 6
    {1,1,1,0}, //channel 7
    {0,0,0,1}, //channel 8
    {1,0,0,1}, //channel 9
    {0,1,0,1}, //channel 10
    {1,1,0,1}, //channel 11
    {0,0,1,1}, //channel 12
    {1,0,1,1}, //channel 13
    {0,1,1,1}, //channel 14
    {1,1,1,1}  //channel 15
  };

  //loop through the 4 sig
  for(int i = 0; i < 4; i ++){
    digitalWrite(boards[file/2][i+1], muxChannel[(file % 2 == 0 ? 8: 0) + rank-1][i]);
  }

  //read the value at the SIG pin
  int val = analogRead(boards[file/2][0]);

  //return the value
  return val;
}
