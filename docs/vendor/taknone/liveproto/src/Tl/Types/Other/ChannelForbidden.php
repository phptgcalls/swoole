<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash string title true broadcast true megagroup int until_date
 * @return Chat
 */

final class ChannelForbidden extends Instance {
	public function request(int $id,int $access_hash,string $title,? true $broadcast = null,? true $megagroup = null,? int $until_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x17d493d5);
		$flags = 0;
		$flags |= is_null($broadcast) ? 0 : (1 << 5);
		$flags |= is_null($megagroup) ? 0 : (1 << 8);
		$flags |= is_null($until_date) ? 0 : (1 << 16);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($title);
		if(is_null($until_date) === false):
			$writer->writeInt($until_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 5)):
			$result['broadcast'] = true;
		else:
			$result['broadcast'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['megagroup'] = true;
		else:
			$result['megagroup'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		if($flags & (1 << 16)):
			$result['until_date'] = $reader->readInt();
		else:
			$result['until_date'] = null;
		endif;
		return new self($result);
	}
}

?>