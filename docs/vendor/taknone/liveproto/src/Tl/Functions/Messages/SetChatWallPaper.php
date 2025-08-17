<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true for_both true revert inputwallpaper wallpaper wallpapersettings settings int id
 * @return Updates
 */

final class SetChatWallPaper extends Instance {
	public function request(object $peer,? true $for_both = null,? true $revert = null,? object $wallpaper = null,? object $settings = null,? int $id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ffacae1);
		$flags = 0;
		$flags |= is_null($for_both) ? 0 : (1 << 3);
		$flags |= is_null($revert) ? 0 : (1 << 4);
		$flags |= is_null($wallpaper) ? 0 : (1 << 0);
		$flags |= is_null($settings) ? 0 : (1 << 2);
		$flags |= is_null($id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($wallpaper) === false):
			$writer->write($wallpaper->read());
		endif;
		if(is_null($settings) === false):
			$writer->write($settings->read());
		endif;
		if(is_null($id) === false):
			$writer->writeInt($id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>