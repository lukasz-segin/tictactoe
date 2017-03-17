<?php

namespace Foo;

class ClassicTicTacToe implements TicTacToeInterface
{
	private $_varsX = array();
	private $_varsO = array();

  /**
   * $x,$y - 0-2
   * @param $x integer
   * @param $y integer
   */
  public function putX($x,$y) {
		/**
		 *	WYJATEK PRZY NADPISYWANIU SWOJEGO POLA
		 */
		for($i=0;$i<count($this->_varsX);$i++) {
			if($this->_varsX[$i++] == $x && $this->_varsX[$i] == $y) throw new \Foo\FieldTakenException('Pole jest zajęte.');
		}

		/**
		 *	WYJATEK PRZY NADPISYWANIU POLA PRZECIWNIKA
		 */
		for($i=0;$i<count($this->_varsO);$i++) {
			if($this->_varsO[$i++] == $x && $this->_varsO[$i] == $y) throw new \Foo\FieldTakenException('Pole jest zajęte.');
		}

  	array_push($this->_varsX, [$x,$y]);
//  	array_push($this->_varsX, $y);

		/**
		 *	WYJATEK PRZY GRANIU DWA RAZY POD RZAD
		 */
  	if( (count($this->_varsX)/2)-2 == (count($this->_varsO)/2) )
  			throw new \Foo\WrongPlayerException('Nie mozna grac dwa razy pod rzad tym samym graczem.');
  }

  public function getX() {
  	return $this->_varsX;
  }

  /**
   * $x,$y - 0-2
   * @param $x integer
   * @param $y integer
   */
  public function putO($x,$y) {
		/**
		 *	WYJATEK PRZY NADPISYWANIU SWOJEGO POLA
		 */
		for($i=0;$i<count($this->_varsO);$i++) {
			if($this->_varsO[$i++] == $x && $this->_varsO[$i] == $y) throw new \Foo\FieldTakenException('Pole jest zajęte.');
		}

		/**
		 *	WYJATEK PRZY NADPISYWANIU POLA PRZECIWNIKA
		 */
		for($i=0;$i<count($this->_varsX);$i++) {
			if($this->_varsX[$i++] == $x && $this->_varsX[$i] == $y) throw new \Foo\FieldTakenException('Pole jest zajęte.');
		}

  	array_push($this->_varsO, [$x,$y]);
//  	array_push($this->_varsO, $y);

		/**
		 *	WYJATEK PRZY GRANIU DWA RAZY POD RZAD
		 */
  	if( (count($this->_varsO)/2) > (count($this->_varsX)/2) )
  			throw new \Foo\WrongPlayerException('Nie mozna grac dwa razy pod rzad tym samym graczem.');
  }

  public function getO() {
  	return $this->_varsO;
  }

  /**
   * W GRE MOZNA WYGRAC TYLKO W TRZECH PIERWSZYCH RUCHACH, POZNIEJ GRA OBSLUGUJE TYLKO BLEDY ORAZ REMIS
   * @return boolean
   */
  public function isEnded() {
  	if(
  			(
	  			/**
	  			 *	KOMBINACJE WYGRANYCH W POZIOMIE DLA KRZYZYKA W TRZECH PIERWSZYCH RUCHACH DANEGO GRACZA
	  			 */
		  		(count($this->_varsX) == 6) && 
		  		(
		    		(
		    			($this->_varsX[0] == 0 && $this->_varsX[1] == 0 && $this->_varsX[2] == 1 && $this->_varsX[3] == 0 && $this->_varsX[4] == 2 && $this->_varsX[5] == 0)
		    			||
		    			($this->_varsX[2] == 0 && $this->_varsX[3] == 0 && $this->_varsX[0] == 1 && $this->_varsX[1] == 0 && $this->_varsX[4] == 2 && $this->_varsX[5] == 0)
		    			||
		    			($this->_varsX[4] == 0 && $this->_varsX[5] == 0 && $this->_varsX[2] == 1 && $this->_varsX[3] == 0 && $this->_varsX[0] == 2 && $this->_varsX[1] == 0)
		    			||
		    			($this->_varsX[0] == 0 && $this->_varsX[1] == 0 && $this->_varsX[4] == 1 && $this->_varsX[5] == 0 && $this->_varsX[2] == 2 && $this->_varsX[3] == 0)
		    			||
		    			($this->_varsX[2] == 0 && $this->_varsX[3] == 0 && $this->_varsX[4] == 1 && $this->_varsX[5] == 0 && $this->_varsX[0] == 2 && $this->_varsX[1] == 0)
		    			||
		    			($this->_varsX[4] == 0 && $this->_varsX[5] == 0 && $this->_varsX[0] == 1 && $this->_varsX[1] == 0 && $this->_varsX[2] == 2 && $this->_varsX[3] == 0)
		  			)
		  			||
		    		(
		    			($this->_varsX[0] == 0 && $this->_varsX[1] == 1 && $this->_varsX[2] == 1 && $this->_varsX[3] == 1 && $this->_varsX[4] == 2 && $this->_varsX[5] == 1)
		    			||
		    			($this->_varsX[2] == 0 && $this->_varsX[3] == 1 && $this->_varsX[0] == 1 && $this->_varsX[1] == 1 && $this->_varsX[4] == 2 && $this->_varsX[5] == 1)
		    			||
		    			($this->_varsX[4] == 0 && $this->_varsX[5] == 1 && $this->_varsX[2] == 1 && $this->_varsX[3] == 1 && $this->_varsX[0] == 2 && $this->_varsX[1] == 1)
		    			||
		    			($this->_varsX[0] == 0 && $this->_varsX[1] == 1 && $this->_varsX[4] == 1 && $this->_varsX[5] == 1 && $this->_varsX[2] == 2 && $this->_varsX[3] == 1)
		    			||
		    			($this->_varsX[2] == 0 && $this->_varsX[3] == 1 && $this->_varsX[4] == 1 && $this->_varsX[5] == 1 && $this->_varsX[0] == 2 && $this->_varsX[1] == 1)
		    			||
		    			($this->_varsX[4] == 0 && $this->_varsX[5] == 1 && $this->_varsX[0] == 1 && $this->_varsX[1] == 1 && $this->_varsX[2] == 2 && $this->_varsX[3] == 1)
		  			)
		  			||
		    		(
		    			($this->_varsX[0] == 0 && $this->_varsX[1] == 2 && $this->_varsX[2] == 1 && $this->_varsX[3] == 2 && $this->_varsX[4] == 2 && $this->_varsX[5] == 2)
		    			||
		    			($this->_varsX[2] == 0 && $this->_varsX[3] == 2 && $this->_varsX[0] == 1 && $this->_varsX[1] == 2 && $this->_varsX[4] == 2 && $this->_varsX[5] == 2)
		    			||
		    			($this->_varsX[4] == 0 && $this->_varsX[5] == 2 && $this->_varsX[2] == 1 && $this->_varsX[3] == 2 && $this->_varsX[0] == 2 && $this->_varsX[1] == 2)
		    			||
		    			($this->_varsX[0] == 0 && $this->_varsX[1] == 2 && $this->_varsX[4] == 1 && $this->_varsX[5] == 2 && $this->_varsX[2] == 2 && $this->_varsX[3] == 2)
		    			||
		    			($this->_varsX[2] == 0 && $this->_varsX[3] == 2 && $this->_varsX[4] == 1 && $this->_varsX[5] == 2 && $this->_varsX[0] == 2 && $this->_varsX[1] == 2)
		    			||
		    			($this->_varsX[4] == 0 && $this->_varsX[5] == 2 && $this->_varsX[0] == 1 && $this->_varsX[1] == 2 && $this->_varsX[2] == 2 && $this->_varsX[3] == 2)
		  			)
					)
					||
	  			/**
	  			 *	KOMBINACJE WYGRANYCH W POZIOMIE DLA KOLKA W TRZECH PIERWSZYCH RUCHACH DANEGO GRACZA
	  			 */
					(count($this->_varsO) == 6) && 
		  		(
		    		(
		    			($this->_varsO[0] == 0 && $this->_varsO[1] == 0 && $this->_varsO[2] == 1 && $this->_varsO[3] == 0 && $this->_varsO[4] == 2 && $this->_varsO[5] == 0)
		    			||
		    			($this->_varsO[2] == 0 && $this->_varsO[3] == 0 && $this->_varsO[0] == 1 && $this->_varsO[1] == 0 && $this->_varsO[4] == 2 && $this->_varsO[5] == 0)
		    			||
		    			($this->_varsO[4] == 0 && $this->_varsO[5] == 0 && $this->_varsO[2] == 1 && $this->_varsO[3] == 0 && $this->_varsO[0] == 2 && $this->_varsO[1] == 0)
		    			||
		    			($this->_varsO[0] == 0 && $this->_varsO[1] == 0 && $this->_varsO[4] == 1 && $this->_varsO[5] == 0 && $this->_varsO[2] == 2 && $this->_varsO[3] == 0)
		    			||
		    			($this->_varsO[2] == 0 && $this->_varsO[3] == 0 && $this->_varsO[4] == 1 && $this->_varsO[5] == 0 && $this->_varsO[0] == 2 && $this->_varsO[1] == 0)
		    			||
		    			($this->_varsO[4] == 0 && $this->_varsO[5] == 0 && $this->_varsO[0] == 1 && $this->_varsO[1] == 0 && $this->_varsO[2] == 2 && $this->_varsO[3] == 0)
		  			)
		  			||
		    		(
		    			($this->_varsO[0] == 0 && $this->_varsO[1] == 1 && $this->_varsO[2] == 1 && $this->_varsO[3] == 1 && $this->_varsO[4] == 2 && $this->_varsO[5] == 1)
		    			||
		    			($this->_varsO[2] == 0 && $this->_varsO[3] == 1 && $this->_varsO[0] == 1 && $this->_varsO[1] == 1 && $this->_varsO[4] == 2 && $this->_varsO[5] == 1)
		    			||
		    			($this->_varsO[4] == 0 && $this->_varsO[5] == 1 && $this->_varsO[2] == 1 && $this->_varsO[3] == 1 && $this->_varsO[0] == 2 && $this->_varsO[1] == 1)
		    			||
		    			($this->_varsO[0] == 0 && $this->_varsO[1] == 1 && $this->_varsO[4] == 1 && $this->_varsO[5] == 1 && $this->_varsO[2] == 2 && $this->_varsO[3] == 1)
		    			||
		    			($this->_varsO[2] == 0 && $this->_varsO[3] == 1 && $this->_varsO[4] == 1 && $this->_varsO[5] == 1 && $this->_varsO[0] == 2 && $this->_varsO[1] == 1)
		    			||
		    			($this->_varsO[4] == 0 && $this->_varsO[5] == 1 && $this->_varsO[0] == 1 && $this->_varsO[1] == 1 && $this->_varsO[2] == 2 && $this->_varsO[3] == 1)
		  			)
		  			||
		    		(
		    			($this->_varsO[0] == 0 && $this->_varsO[1] == 2 && $this->_varsO[2] == 1 && $this->_varsO[3] == 2 && $this->_varsO[4] == 2 && $this->_varsO[5] == 2)
		    			||
		    			($this->_varsO[2] == 0 && $this->_varsO[3] == 2 && $this->_varsO[0] == 1 && $this->_varsO[1] == 2 && $this->_varsO[4] == 2 && $this->_varsO[5] == 2)
		    			||
		    			($this->_varsO[4] == 0 && $this->_varsO[5] == 2 && $this->_varsO[2] == 1 && $this->_varsO[3] == 2 && $this->_varsO[0] == 2 && $this->_varsO[1] == 2)
		    			||
		    			($this->_varsO[0] == 0 && $this->_varsO[1] == 2 && $this->_varsO[4] == 1 && $this->_varsO[5] == 2 && $this->_varsO[2] == 2 && $this->_varsO[3] == 2)
		    			||
		    			($this->_varsO[2] == 0 && $this->_varsO[3] == 2 && $this->_varsO[4] == 1 && $this->_varsO[5] == 2 && $this->_varsO[0] == 2 && $this->_varsO[1] == 2)
		    			||
		    			($this->_varsO[4] == 0 && $this->_varsO[5] == 2 && $this->_varsO[0] == 1 && $this->_varsO[1] == 2 && $this->_varsO[2] == 2 && $this->_varsO[3] == 2)
		  			)
					)
				)
  		)  { return true;
			/**
			 *	CZY WYKORZYSTANO WSZYSTKIE RUCHY
	  	 */
  		} elseif ( (count($this->_varsX) == 8) && (count($this->_varsO) == 10) || (count($this->_varsX) == 10) && (count($this->_varsO) == 8) ) {
  		return true;
  	}
  }

    /**
     *
     * @return boolean
     */
    public function isTied() {
			/**
			 *	CZY WYKORZYSTANO WSZYSTKIE RUCHY
	  	 */
    	if ( (count($this->_varsX) == 8) && (count($this->_varsO) == 10) || (count($this->_varsX) == 10) && (count($this->_varsO) == 8) )
	  		return true;
    }

    /**
     * ('X' or 'O' or false)
     * @return string|false
     */
    public function getWinner() {
    	if (
	  			/**
	  			 *	KOMBINACJE WYGRANYCH W POZIOMIE DLA KRZYZYKA W TRZECH PIERWSZYCH RUCHACH DANEGO GRACZA
	  			 */
	    		(
	    			($this->_varsX[0] == 0 && $this->_varsX[1] == 0 && $this->_varsX[2] == 1 && $this->_varsX[3] == 0 && $this->_varsX[4] == 2 && $this->_varsX[5] == 0)
	    			||
	    			($this->_varsX[2] == 0 && $this->_varsX[3] == 0 && $this->_varsX[0] == 1 && $this->_varsX[1] == 0 && $this->_varsX[4] == 2 && $this->_varsX[5] == 0)
	    			||
	    			($this->_varsX[4] == 0 && $this->_varsX[5] == 0 && $this->_varsX[2] == 1 && $this->_varsX[3] == 0 && $this->_varsX[0] == 2 && $this->_varsX[1] == 0)
	    			||
	    			($this->_varsX[0] == 0 && $this->_varsX[1] == 0 && $this->_varsX[4] == 1 && $this->_varsX[5] == 0 && $this->_varsX[2] == 2 && $this->_varsX[3] == 0)
	    			||
	    			($this->_varsX[2] == 0 && $this->_varsX[3] == 0 && $this->_varsX[4] == 1 && $this->_varsX[5] == 0 && $this->_varsX[0] == 2 && $this->_varsX[1] == 0)
	    			||
	    			($this->_varsX[4] == 0 && $this->_varsX[5] == 0 && $this->_varsX[0] == 1 && $this->_varsX[1] == 0 && $this->_varsX[2] == 2 && $this->_varsX[3] == 0)
	  			)
	  			||
	    		(
	    			($this->_varsX[0] == 0 && $this->_varsX[1] == 1 && $this->_varsX[2] == 1 && $this->_varsX[3] == 1 && $this->_varsX[4] == 2 && $this->_varsX[5] == 1)
	    			||
	    			($this->_varsX[2] == 0 && $this->_varsX[3] == 1 && $this->_varsX[0] == 1 && $this->_varsX[1] == 1 && $this->_varsX[4] == 2 && $this->_varsX[5] == 1)
	    			||
	    			($this->_varsX[4] == 0 && $this->_varsX[5] == 1 && $this->_varsX[2] == 1 && $this->_varsX[3] == 1 && $this->_varsX[0] == 2 && $this->_varsX[1] == 1)
	    			||
	    			($this->_varsX[0] == 0 && $this->_varsX[1] == 1 && $this->_varsX[4] == 1 && $this->_varsX[5] == 1 && $this->_varsX[2] == 2 && $this->_varsX[3] == 1)
	    			||
	    			($this->_varsX[2] == 0 && $this->_varsX[3] == 1 && $this->_varsX[4] == 1 && $this->_varsX[5] == 1 && $this->_varsX[0] == 2 && $this->_varsX[1] == 1)
	    			||
	    			($this->_varsX[4] == 0 && $this->_varsX[5] == 1 && $this->_varsX[0] == 1 && $this->_varsX[1] == 1 && $this->_varsX[2] == 2 && $this->_varsX[3] == 1)
	  			)
	  			||
	    		(
	    			($this->_varsX[0] == 0 && $this->_varsX[1] == 2 && $this->_varsX[2] == 1 && $this->_varsX[3] == 2 && $this->_varsX[4] == 2 && $this->_varsX[5] == 2)
	    			||
	    			($this->_varsX[2] == 0 && $this->_varsX[3] == 2 && $this->_varsX[0] == 1 && $this->_varsX[1] == 2 && $this->_varsX[4] == 2 && $this->_varsX[5] == 2)
	    			||
	    			($this->_varsX[4] == 0 && $this->_varsX[5] == 2 && $this->_varsX[2] == 1 && $this->_varsX[3] == 2 && $this->_varsX[0] == 2 && $this->_varsX[1] == 2)
	    			||
	    			($this->_varsX[0] == 0 && $this->_varsX[1] == 2 && $this->_varsX[4] == 1 && $this->_varsX[5] == 2 && $this->_varsX[2] == 2 && $this->_varsX[3] == 2)
	    			||
	    			($this->_varsX[2] == 0 && $this->_varsX[3] == 2 && $this->_varsX[4] == 1 && $this->_varsX[5] == 2 && $this->_varsX[0] == 2 && $this->_varsX[1] == 2)
	    			||
	    			($this->_varsX[4] == 0 && $this->_varsX[5] == 2 && $this->_varsX[0] == 1 && $this->_varsX[1] == 2 && $this->_varsX[2] == 2 && $this->_varsX[3] == 2)
	  			)
				) { return 'X'; } elseif (
	  			/**
	  			 *	KOMBINACJE WYGRANYCH W POZIOMIE DLA KOLKA W TRZECH PIERWSZYCH RUCHACH DANEGO GRACZA
	  			 */
	    		(
	    			($this->_varsO[0] == 0 && $this->_varsO[1] == 0 && $this->_varsO[2] == 1 && $this->_varsO[3] == 0 && $this->_varsO[4] == 2 && $this->_varsO[5] == 0)
	    			||
	    			($this->_varsO[2] == 0 && $this->_varsO[3] == 0 && $this->_varsO[0] == 1 && $this->_varsO[1] == 0 && $this->_varsO[4] == 2 && $this->_varsO[5] == 0)
	    			||
	    			($this->_varsO[4] == 0 && $this->_varsO[5] == 0 && $this->_varsO[2] == 1 && $this->_varsO[3] == 0 && $this->_varsO[0] == 2 && $this->_varsO[1] == 0)
	    			||
	    			($this->_varsO[0] == 0 && $this->_varsO[1] == 0 && $this->_varsO[4] == 1 && $this->_varsO[5] == 0 && $this->_varsO[2] == 2 && $this->_varsO[3] == 0)
	    			||
	    			($this->_varsO[2] == 0 && $this->_varsO[3] == 0 && $this->_varsO[4] == 1 && $this->_varsO[5] == 0 && $this->_varsO[0] == 2 && $this->_varsO[1] == 0)
	    			||
	    			($this->_varsO[4] == 0 && $this->_varsO[5] == 0 && $this->_varsO[0] == 1 && $this->_varsO[1] == 0 && $this->_varsO[2] == 2 && $this->_varsO[3] == 0)
		  			)
		  			||
		    		(
	    			($this->_varsO[0] == 0 && $this->_varsO[1] == 1 && $this->_varsO[2] == 1 && $this->_varsO[3] == 1 && $this->_varsO[4] == 2 && $this->_varsO[5] == 1)
	    			||
	    			($this->_varsO[2] == 0 && $this->_varsO[3] == 1 && $this->_varsO[0] == 1 && $this->_varsO[1] == 1 && $this->_varsO[4] == 2 && $this->_varsO[5] == 1)
	    			||
	    			($this->_varsO[4] == 0 && $this->_varsO[5] == 1 && $this->_varsO[2] == 1 && $this->_varsO[3] == 1 && $this->_varsO[0] == 2 && $this->_varsO[1] == 1)
	    			||
	    			($this->_varsO[0] == 0 && $this->_varsO[1] == 1 && $this->_varsO[4] == 1 && $this->_varsO[5] == 1 && $this->_varsO[2] == 2 && $this->_varsO[3] == 1)
	    			||
	    			($this->_varsO[2] == 0 && $this->_varsO[3] == 1 && $this->_varsO[4] == 1 && $this->_varsO[5] == 1 && $this->_varsO[0] == 2 && $this->_varsO[1] == 1)
	    			||
	    			($this->_varsO[4] == 0 && $this->_varsO[5] == 1 && $this->_varsO[0] == 1 && $this->_varsO[1] == 1 && $this->_varsO[2] == 2 && $this->_varsO[3] == 1)
		  			)
		  			||
		    		(
	    			($this->_varsO[0] == 0 && $this->_varsO[1] == 2 && $this->_varsO[2] == 1 && $this->_varsO[3] == 2 && $this->_varsO[4] == 2 && $this->_varsO[5] == 2)
	    			||
	    			($this->_varsO[2] == 0 && $this->_varsO[3] == 2 && $this->_varsO[0] == 1 && $this->_varsO[1] == 2 && $this->_varsO[4] == 2 && $this->_varsO[5] == 2)
	    			||
	    			($this->_varsO[4] == 0 && $this->_varsO[5] == 2 && $this->_varsO[2] == 1 && $this->_varsO[3] == 2 && $this->_varsO[0] == 2 && $this->_varsO[1] == 2)
	    			||
	    			($this->_varsO[0] == 0 && $this->_varsO[1] == 2 && $this->_varsO[4] == 1 && $this->_varsO[5] == 2 && $this->_varsO[2] == 2 && $this->_varsO[3] == 2)
	    			||
	    			($this->_varsO[2] == 0 && $this->_varsO[3] == 2 && $this->_varsO[4] == 1 && $this->_varsO[5] == 2 && $this->_varsO[0] == 2 && $this->_varsO[1] == 2)
	    			||
	    			($this->_varsO[4] == 0 && $this->_varsO[5] == 2 && $this->_varsO[0] == 1 && $this->_varsO[1] == 2 && $this->_varsO[2] == 2 && $this->_varsO[3] == 2)
	  			)
				) { return 'O'; } else return false;
    }
}