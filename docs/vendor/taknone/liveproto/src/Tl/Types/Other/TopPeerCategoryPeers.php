<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param toppeercategory category int count Vector<TopPeer> peers
 * @return TopPeerCategoryPeers
 */

final class TopPeerCategoryPeers extends Instance {
	public function request(object $category,int $count,array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfb834291);
		$writer->write($category->read());
		$writer->writeInt($count);
		$writer->tgwriteVector($peers,'TopPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['category'] = $reader->tgreadObject();
		$result['count'] = $reader->readInt();
		$result['peers'] = $reader->tgreadVector('TopPeer');
		return new self($result);
	}
}

?>