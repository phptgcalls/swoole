<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url Vector<PageBlock> blocks Vector<Photo> photos Vector<Document> documents true part true rtl true v2 int views
 * @return Page
 */

final class Page extends Instance {
	public function request(string $url,array $blocks,array $photos,array $documents,? true $part = null,? true $rtl = null,? true $v2 = null,? int $views = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x98657f0d);
		$flags = 0;
		$flags |= is_null($part) ? 0 : (1 << 0);
		$flags |= is_null($rtl) ? 0 : (1 << 1);
		$flags |= is_null($v2) ? 0 : (1 << 2);
		$flags |= is_null($views) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($url);
		$writer->tgwriteVector($blocks,'PageBlock');
		$writer->tgwriteVector($photos,'Photo');
		$writer->tgwriteVector($documents,'Document');
		if(is_null($views) === false):
			$writer->writeInt($views);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['part'] = true;
		else:
			$result['part'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['rtl'] = true;
		else:
			$result['rtl'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['v2'] = true;
		else:
			$result['v2'] = false;
		endif;
		$result['url'] = $reader->tgreadBytes();
		$result['blocks'] = $reader->tgreadVector('PageBlock');
		$result['photos'] = $reader->tgreadVector('Photo');
		$result['documents'] = $reader->tgreadVector('Document');
		if($flags & (1 << 3)):
			$result['views'] = $reader->readInt();
		else:
			$result['views'] = null;
		endif;
		return new self($result);
	}
}

?>