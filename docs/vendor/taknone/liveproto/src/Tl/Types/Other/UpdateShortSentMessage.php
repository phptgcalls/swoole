<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id int pts int pts_count int date true out messagemedia media Vector<MessageEntity> entities int ttl_period
 * @return Updates
 */

final class UpdateShortSentMessage extends Instance {
	public function request(int $id,int $pts,int $pts_count,int $date,? true $out = null,? object $media = null,? array $entities = null,? int $ttl_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9015e101);
		$flags = 0;
		$flags |= is_null($out) ? 0 : (1 << 1);
		$flags |= is_null($media) ? 0 : (1 << 9);
		$flags |= is_null($entities) ? 0 : (1 << 7);
		$flags |= is_null($ttl_period) ? 0 : (1 << 25);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		$writer->writeInt($date);
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['out'] = true;
		else:
			$result['out'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 9)):
			$result['media'] = $reader->tgreadObject();
		else:
			$result['media'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		if($flags & (1 << 25)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		return new self($result);
	}
}

?>