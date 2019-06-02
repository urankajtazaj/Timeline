<?php

class tictactoe extends game
{
	var $player = "X";			//whose turn is
	var $board = array();		//the tic tac toe board
	var $totalMoves = 0;		//how many moves have been made so far		

	/**
	* Purpose: default constructor
	* Preconditions: none
	* Postconditions: parent object started
	**/
	function tictactoe()
	{
		/**
		* instantiate the parent game class so this class
		* inherits all of the game class's attributes
		* and methods
		**/
		game::start();
        $this->newBoard();
	}
	
	/**
	* Purpose: start a new tic tac toe game
	* Preconditions: none
	* Postconditions: game is ready to be displayed
	**/
	function newGame()
	{
		//setup the game
		$this->start();
		
		//reset the player
		$this->player = "X";
		$this->totalMoves = 0;
        $this->newBoard();
	}
    
    /**
	* Purpose: create an empty board
	* Preconditions: none
	* Postconditions: empty board created
	**/
    function newBoard() {
    
        //clear out the board
		$this->board = array();
        
        //create the board
        for ($x = 0; $x <= 2; $x++)
        {
            for ($y = 0; $y <= 2; $y++)
            {
                $this->board[$x][$y] = null;
            }
        }
    }
	
	/**
	* Purpose: run the game until it's tied or someone has won
	* Preconditions: all $_POST content
	* Postconditions: game is in play
	**/
	function playGame($gamedata)
	{
		if (!$this->isOver() && isset($gamedata['move'])) {
			$this->move($gamedata);
        }
			
		//player pressed the button to start a new game
		if (isset($gamedata['newgame'])) {
			$this->newGame();
        }
				
		//display the game
		$this->displayGame();
	}
	
	/**
	* Purpose: display the game interface
	* Preconditions: none
	* Postconditions: start a game or keep playing the current game
	**/
	function displayGame()
	{
		
		//while the game isn't over
		if (!$this->isOver())
		{
			echo "<div id=\"board\">";
			
			for ($x = 0; $x < 3; $x++)
			{
				for ($y = 0; $y < 3; $y++)
				{
					echo "<div class=\"board_cell\">";
					
					//check to see if that position is already filled
					if ($this->board[$x][$y])
						echo "<img src=\"images/{$this->board[$x][$y]}.jpg\" alt=\"{$this->board[$x][$y]}\" title=\"{$this->board[$x][$y]}\" />";
					else
					{
						//let them choose to put an x or o there
						echo "<select name=\"{$x}_{$y}\">
								<option value=\"\"></option>
								<option value=\"{$this->player}\">{$this->player}</option>
							</select>";
					}
					
					echo "</div>";
				}
				
				echo "<div class=\"break\"></div>";
			}
			
			echo "
				<p align=\"center\">
					<input type=\"submit\" name=\"move\" value=\"Vendose\" /><br/><br>
					<h3 style='text-align: center'>Eshte radha e lojtarit {$this->player}</h3></p>
			</div>";
		}
		else
		{
			
			//someone won the game or there was a tie
			if ($this->isOver() != "Tie")
				echo successMsg("Urime " . $this->isOver() . ", ju keni fituar!");
			else if ($this->isOver() == "Tie")
				echo errorMsg("Loja ka perfunduar barazim. Deshironi te luani perseri?");
				
			session_destroy(); 
				
			echo "<p align=\"center\"><input type=\"submit\" name=\"newgame\" value=\"Luaj perseri\" /></p>";
		}
	}
	
	/**
	* Purpose: trying to place an X or O on the board
	* Preconditions: the position they want to make their move
	* Postconditions: the game data is updated
	**/
	function move($gamedata)
	{			

		if ($this->isOver())
			return;

		//remove duplicate entries on the board	
		$gamedata = array_unique($gamedata);
		
		foreach ($gamedata as $key => $value)
		{
			if ($value == $this->player)
			{	
				//update the board in that position with the player's X or O 
				$coords = explode("_", $key);
				$this->board[$coords[0]][$coords[1]] = $this->player;

				//change the turn to the next player
				if ($this->player == "X")
					$this->player = "O";
				else
					$this->player = "X";
					
				$this->totalMoves++;
			}
		}
	
		if ($this->isOver())
			return;
	}
	
	/**
	* Purpose: check for a winner
	* Preconditions: none
	* Postconditions: return the winner if found
	**/
	function isOver()
	{
		
		//top row
		if ($this->board[0][0] && $this->board[0][0] == $this->board[0][1] && $this->board[0][1] == $this->board[0][2])
			return $this->board[0][0];
			
		//middle row
		if ($this->board[1][0] && $this->board[1][0] == $this->board[1][1] && $this->board[1][1] == $this->board[1][2])
			return $this->board[1][0];
			
		//bottom row
		if ($this->board[2][0] && $this->board[2][0] == $this->board[2][1] && $this->board[2][1] == $this->board[2][2])
			return $this->board[2][0];
			
		//first column
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][0] && $this->board[1][0] == $this->board[2][0])
			return $this->board[0][0];
			
		//second column
		if ($this->board[0][1] && $this->board[0][1] == $this->board[1][1] && $this->board[1][1] == $this->board[2][1])
			return $this->board[0][1];
			
		//third column
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][2] && $this->board[1][2] == $this->board[2][2])
			return $this->board[0][2];
			
		//diagonal 1
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2])
			return $this->board[0][0];
			
		//diagonal 2
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][1] && $this->board[1][1] == $this->board[2][0])
			return $this->board[0][2];
			
		if ($this->totalMoves >= 9)
			return "Tie";
	}
}