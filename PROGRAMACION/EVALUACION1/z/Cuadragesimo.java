package z;
public class Cuadragesimo {

	public static void main(String arcccccc[]){
		int tabla1[][] = {{1, 2, 3, 4}, {5, 6, 7, 8}, {9, 10, 11, 12}, {13, 14, 15, 16}};
		int inter;
		int tope = tabla1.length - 1;
		for(int i=0; i<tabla1.length; i++){
			inter = tabla1[i][i];
			tabla1[i][i] = tabla1[i][tope - i];
			tabla1[i][tope - i] = inter;
		}
		
		for(int i=0; i<tabla1.length; i++){
			for(int j=0; j<tabla1[i].length; j++)
				System.out.printf("%d   ", tabla1[i][j]);
			System.out.println();
		}
		
    }
    
    
}