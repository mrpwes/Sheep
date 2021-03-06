<?php
/**
 * Copyright (c) 2017, 2018 KnownUnown
 *
 * This file is part of Sheep.
 *
 * Sheep is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Sheep is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);


namespace Sheep\Updater;

use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use Sheep\PluginState;
use Sheep\Store\Store;

class NagTask extends PluginTask {
	private $store;
	private $message;

	public function __construct(Plugin $owner, Store $store, string $message) {
		parent::__construct($owner);

		$this->store = $store;
		$this->message = $message;
	}

	public function onRun(int $currentTick) {
		$this->getOwner()->getLogger()->warning(
			sprintf($this->message, count($this->store->getByState(PluginState::STATE_UPDATING))));
	}
}
