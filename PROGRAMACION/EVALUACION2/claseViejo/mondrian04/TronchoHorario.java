package claseViejo.mondrian04;

import java.awt.*;
import java.util.Random;

public class TronchoHorario
{
	
	int posX, posY;
	int ancho, alto;
	
	Color color;
	Color[] colores = {Color.RED, Color.CYAN, Color.GRAY, Color.DARK_GRAY, Color.LIGHT_GRAY, Color.BLUE, Color.BLACK, Color.ORANGE, Color.PINK, Color.MAGENTA, Color.YELLOW, Color.GREEN};
	Random aleatorio = new Random();
	
	static final byte ARRIBA = 0;
	static final byte ABAJO = 1;
	static final byte DCHA = 4;
	static final byte IZQ = 2;
	byte direccion;
	
	static final int margen = 30;
	int TECHO, SUELO, PARED_I, PARED_D;
	int velocidadX = 1, velocidadY = 1;
	
	public TronchoHorario(int x, int y, int ancho, int alto, Color color)
	{
		posX = x;
		posY = y;
		this.ancho = ancho;
		this.alto = alto;
		this.color = color;
		this.direccion = DCHA;
		
		TECHO = y;
		SUELO = y + margen;
		PARED_I = x;
		PARED_D = x  + margen;
		
	}
	
	public void mostrar(Graphics ggez)
	{
		ggez.setColor(color);
		//ggez.setColor(colores[aleatorio.nextInt(colores.length)]);
		//ggez.drawRect(posX, posY, ancho, alto);
		ggez.setColor(color);
		ggez.fillRect(posX, posY, ancho, alto);
	}

	public void mueve()
	{
		velocidadX = aleatorio.nextInt(15);
		velocidadY = aleatorio.nextInt(15);
		switch (direccion){
		case ARRIBA:
			posY -= velocidadY;
			if (posY <= TECHO){
				direccion = DCHA;
			}
			break;
		case ABAJO:
			posY += velocidadY;
			if (posY >= SUELO){
				direccion = IZQ;
			}
			break;
		case DCHA:
			posX += velocidadX;
			if (posX >= PARED_D){
				direccion = ABAJO;
			}
			break;
		case IZQ:
			posX -= velocidadX;
			if (posX <= PARED_I){
				direccion = ARRIBA;
			}
			break;
	}
	}
}
	
