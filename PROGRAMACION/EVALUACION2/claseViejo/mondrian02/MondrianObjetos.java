package claseViejo.mondrian02;

import java.applet.Applet;
import java.awt.*;
import java.util.*;

public class MondrianObjetos extends Applet implements Runnable
{
	Thread ani;
	Graphics ninja;
	Image imagen;
	
	final int HEIGHT = 300, WIDTH = 300; // Del Applet
	
	final int numeroRectangulos = 5;
	
	int[] posicionesX = {0, 250, 80, 80, 100, 80, 200, 0, 200};
	int[] posicionesY = {0, 0, 110, 200, 10, 0, 100, 110, 55};
	int[] anchuras = {90, 40, 100, 220, 90, 110, 45, 70, 60};
	int[] alturas = {90, 190, 20, 90, 80, 90, 45, 200, 135};
	
	Color[] colores = {Color.RED, Color.CYAN, Color.GRAY, Color.DARK_GRAY, Color.LIGHT_GRAY, Color.BLUE, Color.BLACK, Color.ORANGE, Color.PINK};
	
	Random aleatorio = new Random();
	
	TronchoHorario[] rectangulos = new TronchoHorario[numeroRectangulos];
	TronchoAntiHorario[] antiRectangulos = new TronchoAntiHorario[numeroRectangulos];
	
	public void init(){
		
		imagen = this.createImage(HEIGHT, WIDTH);
		ninja = imagen.getGraphics();
		
		for (int i = 0; i < numeroRectangulos; i++)
		{
				rectangulos[i] = new TronchoHorario(posicionesX[i], posicionesY[i], alturas[i], anchuras[i], colores[i]);
				antiRectangulos[i] = new TronchoAntiHorario(posicionesX[i], posicionesY[i], alturas[i], anchuras[i], colores[i]);
		}
	}
	public void start(){
		ani = new Thread(this);
		ani.start();
	}
	
	public void run() {
		while(true){
			for (int i = 0; i < numeroRectangulos; i++)
			{
				rectangulos[i].mueve();
				antiRectangulos[i].mueve();
			}
			repaint();
			try{
				Thread.sleep(60);
			}
			catch (InterruptedException e){};
		}
	}
	
	public void paint (Graphics gg){
		for (int i = 0; i < numeroRectangulos; i++)
		{
			rectangulos[i].mostrar(gg);
			antiRectangulos[i].mostrar(gg);
			
		}
	}

}
