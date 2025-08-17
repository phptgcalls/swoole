<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id int button_id string url
 * @return UrlAuthResult
 */

final class RequestUrlAuth extends Instance {
	public function request(? object $peer = null,? int $msg_id = null,? int $button_id = null,? string $url = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x198fb446);
		$flags = 0;
		$flags |= is_null($peer) ? 0 : (1 << 1);
		$flags |= is_null($msg_id) ? 0 : (1 << 1);
		$flags |= is_null($button_id) ? 0 : (1 << 1);
		$flags |= is_null($url) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
		if(is_null($msg_id) === false):
			$writer->writeInt($msg_id);
		endif;
		if(is_null($button_id) === false):
			$writer->writeInt($button_id);
		endif;
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
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