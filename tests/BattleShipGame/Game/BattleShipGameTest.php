<?php

namespace App\Tests\BattleShipGame\Game;


use App\BattleShipGame\Game\BattleshipGame;
use App\BattleShipGame\Game\PhaseService;
use App\Tests\DomainTest;

class BattleShipGameTest extends DomainTest
{
    /**
     * @var BattleshipGame
     */
    private $game;

    public function setUp()
    {
        parent::setUp();
    }

    public function testNewGame()
    {
        $game = new BattleshipGame();
        $this->assertEquals($this->phaseService->preparing(), $game->phase(), "A new game is expected to be in the preparing phase.");
    }

    public function testGamePlay()
    {
        $this->game = new BattleshipGame();
        $this->game->addShipsAtRandom($this->game->currentPlayer());
        //$this->game->addShipsAtRandom($this->game->waitingPlayer());

        $this->assertEquals($this->phaseService->playing(), $this->game->phase(), "The game is expected to be in the playing phase.");
//        $this->assertEquals("Player 1", $game->currentPlayer(), "Player 1 is excpected to be the current player.");
//        //Manual play
//        $this->assertEquals("Computer", $game->currentPlayer(), "Computer is excpected to be the current player.");
//        //Manual play
//        $this->assertEquals("Player 1", $game->currentPlayer(), "Player 1 is excpected to be the current player.");
//        //Autoplay computer
//        $this->assertEquals("Player 1", $game->currentPlayer(), "Player 1 is excpected to be the current player.");
    }
}