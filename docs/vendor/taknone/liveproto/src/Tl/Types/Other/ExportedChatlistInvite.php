<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string url Vector<Peer> peers
 * @return ExportedChatlistInvite
 */

final class ExportedChatlistInvite extends Instance {
	public function request(string $title,string $url,array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc5181ac);
		$flags = 0;
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($url);
		$writer->tgwriteVector($peers,'Peer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		$result['url'] = $reader->tgreadBytes();
		$result['peers'] = $reader->tgreadVector('Peer');
		return new self($result);
	}
}

?>