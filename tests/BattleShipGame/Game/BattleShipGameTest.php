<?php

namespace App\Tests\BattleShipGame\Game;


use App\BattleShipGame\Game\BattleshipGame;
use App\Tests\DomainTest;

class BattleShipGameTest extends DomainTest
{
    public function test()
    {
        $game = new BattleshipGame();
        $numberOfPlayers = 2;

        $this->assertAttributeCount($numberOfPlayers, 'players', $game, "The number of players in the game is incorrect.");
        $this->assertAttributeCount($numberOfPlayers, 'fleets', $game, "The number of fleets in the game is incorrect.");
        $this->assertAttributeCount($numberOfPlayers, 'grids', $game, "The number of grids in the game is incorrect.");
    }
}